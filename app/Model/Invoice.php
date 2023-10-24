<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Invoice extends AppModel{
    public $name = 'Invoice';
	public $primaryKey = 'id';
	public $useTable = 'invoices';

	public function getAllPendingInvoices(){
		$data = $this->find('all',array('conditions'=>array('status'=>7)));
		return $data;
	}

	public function getInvoiceById($id){
		$data = $this->find('all',array('conditions'=>array('id'=>$id)));
		return $data;
	}

	public function getInvoiceByInvoiceNo($invoice_no){
		$data = $this->find('all',array('conditions'=>array('invoice_no'=>$invoice_no)));
		return $data;
	}

	public function getInvoiceByAddress($address){
		$data = $this->find('all',array('conditions'=>array('address'=>$address)));
		return $data;
	}

	public function updateInvoiceStatus($id,$status){
		return $this->updateAll(array('status'=>$status),array('id'=>$id));
	}


	public function generateInvoice($length){
        $chars = "1234567890";
        $clen   = strlen( $chars )-1;
        $id  = '';

        for ($i = 0; $i < $length; $i++) {
            $id .= $chars[mt_rand(0,$clen)];
        }
        return ($id);
    }

}
?>