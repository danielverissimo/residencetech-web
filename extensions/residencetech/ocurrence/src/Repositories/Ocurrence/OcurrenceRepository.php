<?php namespace Residencetech\Ocurrence\Repositories\Ocurrence;

use Firework\Common\Repositories\CrudTrait;
use Firework\Media\Repositories\MediaTrait;
use Sentinel, Session, DB, Log;
use Carbon\Carbon;

class OcurrenceRepository implements OcurrenceRepositoryInterface {

	use CrudTrait{
		find as findTrait;
		delete as deleteTrait;
	}
	use MediaTrait;

	public function grid()
	{
		$model = $this->createModel();
		$ocurrence = $model->getTable();
		$people = $model->person()->getRelated()->getTable();

		$canListAll = Sentinel::check()->hasAccess('ocurrence.list_all');

		$user = Sentinel::getUser();
		$personId = $user->person()->first()->id;

		$apartmentComplexId = Session::get('current_apartmentcomplex.id');

		$select = $model
		->select(
			$people.'.name'
		)->leftJoin($people, $people.'.id', '=', $ocurrence.'.person_id');

		$select->where($ocurrence.'.apartment_complex_id','=', $apartmentComplexId);

		if ( ! $canListAll ) {
			$select->where($ocurrence . '.person_id', '=', $personId);
		}

		$select->whereNull($ocurrence . '.closed_at');

		return $select;
	}

	public function listAll($personId, $closed = false){

		$ocurrences = $this->createModel()->wherePersonId($personId);

		if ( $closed ){
			$ocurrences->whereNotNull('closed_at');
		}else{
			$ocurrences->whereNull('closed_at');
		}

		return $ocurrences->get();
	}

	public function createOcurrence(array $ocurrence, $mediasId = []){

		list($messages, $model) = $this->create($ocurrence);

		if ($messages->isEmpty())
		{
			$this->updateMedias($mediasId, $model->id);

		}

		return $model;
	}

	private function updateMedias($mediasId, $parentId)
	{

		if ( !empty($mediasId) ){
			foreach ($mediasId as $mediaId) {

				DB::table('media_relation')
				->where('media_id', $mediaId)
				->update(array(
					'parent_id' => $parentId,
					'temp' => false,
				));

			}
		}
	}

	public function delete($id)
	{
		$result = $this->deleteTrait($id);

		if ( $result ){
			$relations = DB::table('media_relation')->where('parent_id', $id)->get();

			foreach ($relations as $relation) {
				$this->deleteMedia($relation->media_id);
			}
		}
	}

	public function close($id)
	{
		return $this->update($id, array('closed_at' => Carbon::now()));
	}

	public function deleteMedia($mediaId)
	{

		$media = DB::table('media')->where('id', $mediaId);

		$media_relation = DB::table('media_relation')->where('media_id', $mediaId);
		$media_relation->delete();

		$this->cleanMediaFile($media);

		$media->delete();
	}

	private function cleanMediaFile($media){
		$path = $media->first()->path;
		\File::delete(storage_path().'/files/'.$path);
	}

	public function findWithMedia($id)
	{

		$occurrence = $this->findTrait($id);

		$medias = DB::table('media')
					->select('media.id as id', 'media.thumbnail as thumbnail', 'media.updated_at as updated_at')
					->join('media_relation', 'media_relation.media_id', '=', 'media.id')
					->where('media_relation.parent_id', $id)
					->where('media_relation.temp', false)
					->get();

		foreach ($medias as $media) {
			$media->updated_at = Carbon::createFromFormat('Y-m-d H:i:s', $media->updated_at)->format('d/m/Y H:i:s');
		}
		$occurrence->setAttribute('medias', $medias);

		$replies = $occurrence->replies()->orderBy('id', 'desc')->get();
		$occurrence->setAttribute('replies', $replies);

		return $occurrence;
	}

}
