<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CertSearch extends Component
{
    public $api_called;
    public $cert_num;
    public $certifier;
    public $date;

    public function render()
    {
        return view('livewire.cert-search');
    }

    private function search()
    {
        $this->api_called = false;

        if ($this->certifier == 'NGC') {
            // Check the database to see if we have a record for this cert number.
            $this->date = DB::table('ngc_certs')->where('cert', '=', strstr($this->cert_num, '-', true))->value('date');

            // If we don't, make a call to the API and store a successful result.
            if (is_null($this->date)) {
                $this->api_called = true;
                $response = Http::get('http://api.collectiblesgroup.com/NGC/Certifications/?token=E43232B7-DFEA-4040-988E-E24333C3FFD4&certNumber=' . $this->cert_num);
                
                if (!is_null($response['EncapsulationDate'])) {
                    $this->date = Carbon::parse($response['EncapsulationDate'])->toDateString();

                    DB::table('ngc_certs')->insert([
                        'cert' => strstr($this->cert_num, '-', true),
                        'date' => $this->date
                    ]);
                }
            }
        }

        // Record the submission.
        DB::table('submissions')->insert([
            'certifier' => $this->certifier,
            'cert_num' => $this->cert_num,
            'date_found' => !is_null($this->date),
            'submitted_on' => Carbon::now()->toDateTimeString()
        ]);
    }

    public function submit($formData)
    {
        $this->cert_num = trim($formData['cert_num']);
        if ($this->validateCert()) {
            $this->search();
        }
    }

    public function validateCert()
    {
        $length = mb_strlen($this->cert_num);

        // Check if input could be an NGC cert number.
        if (strpos($this->cert_num, '-') !== false) {
            if ($length >= 10 && $length <= 11) {
                $this->certifier = 'NGC';
                return true;
            }
        }

        // Check if input could be a PCGS cert number.
        if ($length >= 7 && $length <= 8) {
            $this->certifier = 'PCGS';
            return true;
        }

        // Input does not appear to be either NGC or PCGS.
        return false;
    }
}
