<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Emailsetting;
use App\ProductOrder;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class ProductOrderController extends Controller
{
    public function all(Request $request)
    {

        if($request->has('status'))
        {
            switch ($request->status) {
                case ProductOrder::PENDING_STATUS:
                    $orders = ProductOrder::where('order_status', ProductOrder::PENDING_STATUS)->latest()->get();
                    break;
                
                case ProductOrder::PROCESSING_STATUS:
                    $orders = ProductOrder::where('order_status', ProductOrder::PROCESSING_STATUS)->latest()->get();
                    break;
                
                case ProductOrder::COMPLETED_STATUS:
                    $orders = ProductOrder::where('order_status', ProductOrder::COMPLETED_STATUS)->latest()->get();
                    break;
                
                case ProductOrder::REJECTED_STATUS:
                    $orders = ProductOrder::where('order_status', ProductOrder::REJECTED_STATUS)->latest()->get();
                    break;
                
                default:
                    $orders = ProductOrder::orderBy('id', 'DESC')->get();
                    break;
            }
        }
        else
        {
            $orders = ProductOrder::orderBy('id', 'DESC')->get();
        }

        return view('admin.product.order.index', compact('orders'));
    }

    public function pending(Request $request)
    {
        $data['orders'] = ProductOrder::where('order_status', 'pending')->orderBy('id', 'DESC')->get();
        return view('admin.product.order.index', $data);
    }

    public function processing(Request $request)
    {
        $search = $request->search;
        $data['orders'] = ProductOrder::where('order_status', 'processing')->orderBy('id', 'DESC')->get();
        return view('admin.product.order.index', $data);
    }

    public function completed(Request $request)
    {
        $search = $request->search;
        $data['orders'] = ProductOrder::where('order_status', 'completed')->orderBy('id', 'DESC')->get();
        return view('admin.product.order.index', $data);
    }

    public function rejected(Request $request)
    {
        $search = $request->search;
        $data['orders'] = ProductOrder::where('order_status', 'rejected')->orderBy('id', 'DESC')->get();
        return view('admin.product.order.index', $data);
    }

    public function status(Request $request)
    {

        $po = ProductOrder::find($request->order_id);
        $po->order_status = $request->order_status;
        $po->save();

        $user = User::findOrFail($po->user_id);
        $em = Emailsetting::first();
        $sub = 'Order Status Update';
         // Send Mail to Buyer
         $mail = new PHPMailer(true);

      
         if ($em->is_smtp == 1) {
             try {
                $mail->isSMTP();
                $mail->Host       = $em->smtp_host;
                $mail->SMTPAuth   = true;
                $mail->Username   = $em->smtp_user;
                $mail->Password   = $em->smtp_pass;
                $mail->SMTPSecure = $em->email_encryption;
                $mail->Port       = $em->smtp_port;

                 //Recipients
                 $mail->setFrom($em->from_email, $em->from_name);
                 $mail->addAddress($user->email, $user->name);

                 // Content
                 $mail->isHTML(true);
                 $mail->Subject = $sub;
                 $mail->Body    = 'Bonjour <strong>' . $user->name . '</strong>,<br/>Votre commande est '.$request->order_status.'.<br/>Merci et Bonne journée.';
                 $mail->send();
             } catch (Exception $e) {
                 // die($e->getMessage());
             }
         } else {
             try {

                 //Recipients
                 $mail->setFrom($em->from_mail, $em->from_name);
                 $mail->addAddress($user->email, $user->name);


                 // Content
                 $mail->isHTML(true);
                 $mail->Subject = $sub ;
                 $mail->Body    = 'Bonjour <strong>' . $user->name . '</strong>,<br/>Votre commande est '.$request->order_status.'.<br/>Merci et Bonne journée.';
                 $mail->send();
             } catch (Exception $e) {
                 // die($e->getMessage());
             }
         }

         $notification = array(
            'messege' => 'Le statut de la commande a été modifié avec succès!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function details($id)
    {
        $order = ProductOrder::findOrFail($id);
        return view('admin.product.order.details',compact('order'));
    }



    public function orderDelete(Request $request)
    {
        $order = ProductOrder::findOrFail($request->order_id);
        @unlink('assets/front/invoices/product/'.$order->invoice_number);
        foreach($order->orderitems as $item){
            $item->delete();
        }
        $order->delete();

        $notification = array(
            'messege' => 'Commande produit supprimé avec succès !',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

}
