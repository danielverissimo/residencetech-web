<?php

use Illuminate\Database\Seeder;
use Firework\Common\Seeder\CsvTrait;

class PeopleTableSeeder extends Seeder {

    use CsvTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $personRepository = App::make('Mobileinn\People\Repositories\Person\PersonRepositoryInterface');

        $header = ['name', 'user_id', 'gender', 'email'];
        $data = $this->parseCsv(__DIR__.'/data/person.csv', $header);
        dd($data);

        $this->seed($data, $personRepository);
    }

}
