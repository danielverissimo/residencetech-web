<?php

use Illuminate\Database\Seeder;
use Firework\Common\Seeder\CsvTrait;

class DocumentTypesTableSeeder extends Seeder {

    use CsvTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $documentTypeRepository = App::make('Mobileinn\People\Repositories\Person\DocumentTypeRepositoryInterface');

        $header = ['name'];
        $data = $this->parseCsv(__DIR__.'/data/document_type.csv', $header);

        $this->seed($data, $documentTypeRepository);
    }

}
