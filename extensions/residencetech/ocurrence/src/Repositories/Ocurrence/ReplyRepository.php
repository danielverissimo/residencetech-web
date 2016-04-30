<?php namespace Residencetech\Ocurrence\Repositories\Ocurrence;

use Firework\Common\Repositories\CrudTrait;
use Sentinel, Session, DB, Log;
use Carbon\Carbon;

class ReplyRepository implements ReplyRepositoryInterface {

	use CrudTrait;

    public function createReply(array $input)
    {

        $user = Sentinel::getUser();
        $personId = $user->person()->first()->id;
        $input['person_id'] = $personId;

        return $this->create($input);
    }

}
