<?php namespace Residencetech\Ocurrence\Controllers\Api\V1;

use Illuminate\Routing\Controller as BaseController;
use Residencetech\Ocurrence\Repositories\Ocurrence\OcurrenceRepositoryInterface;
use Residencetech\Ocurrence\Repositories\Ocurrence\ReplyRepositoryInterface;
use Firework\Media\Repositories\MediaRepositoryInterface;
use Sentinel;
use Input;
use Session;
use Carbon\Carbon;
use Log;

class OcurrencesController extends BaseController {

    protected $ocurrenceRepository;
    protected $media;

    public function __construct(OcurrenceRepositoryInterface $ocurrenceRepository, MediaRepositoryInterface $media, ReplyRepositoryInterface $replyRepository)
    {
        $this->ocurrenceRepository = $ocurrenceRepository;
        $this->media = $media;
        $this->replyRepository = $replyRepository;
    }

    public function listOcurrences()
    {

        $user = Sentinel::getUser();
        $personId = $user->person()->first()->id;

        $occurrencesResult = [];
        $ocurrences = $this->ocurrenceRepository->where('person_id', '=', $personId)->get();

        foreach ($ocurrences as $index => $ocurrence) {

            // $p = $this->getHTMLData($ocurrence['data']);
            $p = $ocurrence['data'];
            if ( strlen($p) > 35 ){
                $smallData = substr($p, 0, 32) . "...";
            }else{
                $smallData = '<b>' . $p . '</b>';
            }

            // $smallData = $ocurrence['data'];

            $oc = array(
                "id" => $ocurrence['id'],
                "data" => $ocurrence['data'],
                "created_at" => $ocurrence['created_at'],
                "updated_at" => $ocurrence['updated_at'],
                "small_data" => $smallData
            );


            $firstReply = $ocurrence->replies->first();

            if ( count($ocurrence->replies)  == 0 ){
                $h = $ocurrence->updated_at->diffInHours(Carbon::now());
                Log::info($h);
                if ( $h < 24 ){
                    $oc['track'] = 'little';
                }else if ( $h > 24 && $h < 48){
                    $oc['track'] = 'mid';
                }else{
                    $oc['track'] = 'high';
                }
            }else{
                $oc['track'] = 'little';
            }

            $occurrencesResult[] = $oc;
        }

        return $occurrencesResult;
    }

    public function create()
    {
        $user = Sentinel::getUser();

        $apartmentComplexId = 1; //Session::get('current_apartmentcomplex.id');
        $personId = $user->person()->first()->id;
        $anonym = Input::get('anonym');

        Log::info($anonym);
        if ( $anonym === "true") {
            $personId = null;
        }

        $ocurrence = array(
            "data" => Input::get('data'),
            "apartment_complex_id" => $apartmentComplexId,
            "person_id" => $personId
        );

        $medias = Input::get('medias');
        return $this->ocurrenceRepository->createOcurrence($ocurrence, $medias);
    }

    public function createReply()
    {
        $input = Input::all();
        $reply = array(
            "ocurrence_id" => $input['ocurrence_id'],
            "data" => $input['data']
        );

        $this->replyRepository->createReply($reply);

        return $this->ocurrenceRepository->find($input['ocurrence_id'])->replies()->orderBy('id', 'desc')->get();
    }

    public function update($id)
    {
        $user = Sentinel::getUser();
        $personId = $user->person()->first()->id;

        $ocurrence = array(
            "data" => Input::get('data'),
        );

        return $this->ocurrenceRepository->update($id, $ocurrence);
    }

    public function delete($id)
    {
        $this->ocurrenceRepository->delete($id);
    }

    public function deleteMedia($id)
    {
        $this->ocurrenceRepository->deleteMedia($id);
    }

    public function deleteMediaByRelation($id)
    {
        $this->ocurrenceRepository->deleteMediaByRelation($id);
    }

    public function edit($id)
    {
        return $this->ocurrenceRepository->findWithMedia($id);
    }

    public function upload()
    {
        $file = request()->file('file');

        $input = request()->input();

        $hash = Input::get('hash');
        if ( !Input::has('hash') && !Input::has('parent_id') ){
            $hash = str_random(32);
            $input = array_merge($input, array("hash" => $hash));
        }

        if ($this->media->validForUpload($file))
        {
            if ($media = $this->media->upload($file, $input))
            {

                // Log::info(Carbon::createFromFormat('Y-m-d H:i:s', $media->updated_at)->format('d/m/Y H:i:s'));

                // $media->updated_at = $media->updated_at;

                return response($media);
            }
        }

        return response($this->media->getError(), 400);
    }

    private function get_inner_html( $node ) {
        $innerHTML= '';
        $children = $node->childNodes;
        foreach ($children as $child) {
            $innerHTML .= $child->ownerDocument->saveXML( $child );
        }

        return $innerHTML;
    }

    private function getHTMLData($data = ""){
        $dom = new \DOMDocument();
        $dom->loadHTML($data);

        $html = $dom->getElementsByTagName('html');

        $p = $html[0]->getElementsByTagName('p')[0];
        $children = $p->childNodes;

        foreach ($children as $child) {
            if ( strcmp($child->nodeName, "#text") != 0){
                $p->removeChild($child);
            }
        }

        return $this->get_inner_html($p);
    }

}
