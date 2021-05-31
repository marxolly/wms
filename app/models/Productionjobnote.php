<?php

/**
    * Prodution Job Note Class
    *

    * @author     Mark Solly <mark.solly@fsg.com.au>

        FUNCTIONS

        addJob($data)
        editJob($data)
        getAllJobs($status_id = 0)
        getJobById($id = 0)
        jobNumberExists($job_number)
        updateJobStatus($job_id, $status_id)

    */

class Productionjobnote extends Model{
    public $table = "production_jobs_notes";

    public function addNote($data)
    {
        $db = Database::openConnection();
        if(!isset($data['note_type']))
            $data['note_type'] = "production";
        $id = $db->insertQuery($this->table, $data);
        return $id; 
    }

}