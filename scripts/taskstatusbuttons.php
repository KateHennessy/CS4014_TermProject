<?php
 class TaskStatusButtons{


   public static function create_task_status_button($status){
     if(!is_null($status)){
         switch($status){
           case "unclaimed":
           return '<div><label for="primary" class="btn btn-info removeHover">Not Claimed</label></div>';
           case "in progress":
           return '<div><label for="warning" class="btn btn-warning removeHover">In Progress</label></div>';
           case "expired":
           return '<div><label for="danger" class="btn btn-danger removeHover">Expired</label></div>';
           case "cancelled":
           return '<div><label for="danger" class="btn btn-danger removeHover">Cancelled</label></div>';
           case "unfinished":
           return '<div><label for="danger" class="btn btn-danger removeHover">Unfinished</label></div>';
           case "complete":
           return '<div><label for="danger" class="btn btn-success removeHover">Complete</label></div>';
           default:
          return '';
        }
     }else{
       return '';
     }
   }
 }
 ?>
