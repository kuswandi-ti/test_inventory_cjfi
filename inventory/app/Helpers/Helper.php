<?php

namespace App\Helpers;

use DB;

class Helper {
    /**
     * Create document number
     *
     * @param  string $transaction_name = Initialization of Transaction
     * @param  int $transaction_month = Month of Transaction
     * @param  int $transaction_year = Year of Transaction
     * @param  int $transaction_current_docno = Current Document Number of Transaction
     * @param  int $transaction_description = Description of Transaction
     * @return string
     */
    public static function create_doc_no($transaction_name, $transaction_month, $transaction_year, $transaction_description)
    {
        $count = DB::table('doc_counter')
                     ->where([['transaction_name', $transaction_name], ['transaction_month', $transaction_month], ['transaction_year', $transaction_year]])
                     ->count();
        if ($count == 0) {
            $curr_doc_number = 1;
            DB::table('doc_counter')->insert([
                [
                    'transaction_name'          => $transaction_name,
                    'transaction_month'         => $transaction_month,
                    'transaction_year'          => $transaction_year,
                    'transaction_current_docno' => $curr_doc_number,
                    'transaction_description'   => $transaction_description
                ]
            ]);
        } else {
            $current_no = DB::table('doc_counter')
			              ->select('transaction_current_docno')
						  ->where([['transaction_name', $transaction_name], ['transaction_month', $transaction_month], ['transaction_year', $transaction_year]])
						  ->value('transaction_current_docno');
			$curr_doc_number = $current_no + 1;
            DB::table('doc_counter')
                ->where([['transaction_name', $transaction_name], ['transaction_month', $transaction_month], ['transaction_year', $transaction_year]])
                ->update(['transaction_current_docno' => $curr_doc_number]
            );
        }
        return $transaction_name.'-'.substr('00'.$transaction_year, -2).substr('00'.$transaction_month, -2).'-'.substr('0000'.$curr_doc_number, -4); // XX-YYMM-XXXX
    }
}
