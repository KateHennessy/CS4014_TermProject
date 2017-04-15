<?php

  require_once __DIR__.'/../models/Task.class.php';

 class detailedTaskView{
   private $task;

public static function createTaskHTML($task){
  if(!is_null($task->get_id())){
    $tags ="";
      foreach($task->get_tags() as $aTag){
      $tags .='<h4><span class="label label-primary">'.$aTag->get_name() .'</span></h4> ';
    }
    return '<div class="panel panel-default">
              <div class="panel-heading">
                <div class="">
                    <h2>' .$task->get_title() .'</h2>
                </div>
              </div>
              <br />
              <div class="panel-body">
                    <div class = "row">
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="Task Type">Task Type: </label>
                            <div class="col-md-9">
                                <div>' .$task->get_type() .'</div>
                          </div>
                        </div>
                      </div>
                      <hr />

                      <div class = "row">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Brief Description Of The Task:</label>
                            <div class="col-md-9">
                              <div><p class="text-justify">' .$task->get_description() .'</p></div>
                            </div>
                        </div>
                      </div>
                      <hr/>
                      <div class = "row">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tags: </label>
                            <div class="col-md-9">
                              <div>'  .$tags .' </div>
                          </div>
                        </div>
                      </div>
                      <hr />
                      <div class = "row">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Claim By Date: </label>
                            <div class="col-md-9">
                              <div> ' .$task->get_claim_deadline()->format('D d/m/y') .'</div>
                          </div>
                        </div>
                      </div>
                      <hr />

                      <div class = "row">
                        <div class="form-group">
                          <label class="col-md-3 control-label">Due Date: </label>
                              <div class="col-md-9">
                                <div>' .$task->get_completion_deadline()->format('D d/m/y') .'</div>
                              </div>
                          </div>
                      </div>
                      <hr />

                      <div class = "row">
                          <div class="form-group">
                              <label class="col-md-3 control-label">Number of Pages: </label>
                                <div class="col-md-9">
                                  <div>' .$task->get_no_pages() .'</div>
                                </div>
                            </div>
                          </div>
                          <hr />

                            <div class = "row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Number of Words: </label>
                                <div class="col-md-9">
                                  <div>' .$task->get_no_words() .'</div>
                                </div>
                            </div>
                          </div>
                          <hr />

                          <div class = "row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Document Type: </label>
                                  <div class="col-md-9">
                                    <div>' .$task->get_format().'</div>
                                  </div>
                            </div>
                          </div>
                          <hr />
                          <div class = "row">
                            <div class="form-group">
                              <form method="post">
                                <label class="col-md-3 control-label">Preview: </label>
                                  <div class="col-md-9">
                                    <div><button name="download" class="btn btn-primary"> Click Here For Preview</button></div>
                                  </div>
                                </form>
                            </div>
                        </div>
              </div>
              <div class="panel-footer" style="min-height:90px">';
  }
else return '';

}
public static function createNotFoundTaskHTML(){
  return '  <div class="col-xs-12"> <h2 class="text-danger text-center"> <i class= "glyphicon glyphicon-exclamation-sign"></i> Task Not Found </h2>
      <p class="small text-center"> This task is not available. Please find another task.</p>
    </div>';
}

   public static function createView($viewType, $task){
     $view = null;
     switch($viewType) {
         case "Creator":
             return  self::createCreatorView($task);
         case "Claimer":
             return self::createClaimerView($task);
         case "BannedTask":
             return self::createBannedView();
         case "Flagged":
             return self::createFlaggedView();
         case "PotentialClaimer":
             return self::createPotentialClaimerView();
         case "Status":
             $ret = self::generateStatus($modelData);
             break;

         default:
             return "Unable to build model" . $modelName ."If you are a user please contact the system administrator";
    }


 }

   public static function createCreatorView($task){

     switch($task->get_status()->get_name()){
       case "unclaimed":
       return  '<span class="pull-right">
                  <div>
                    <label for="primary" class="btn btn-info removeHover">Not Claimed</label>
                  </div>
                </span>';
       case "in progress":
       return  '<span class="">
                  <div class="row">
                    <div class="pull-right">
                      <label for="warning" class="btn btn-warning removeHover">In Progress</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="pull-right">Contact the claimer at: <span class="text-info">'.UserDAO::getUserByID($task->get_claimer_id())->get_email() .' </span>
                    </div>
                  </div>
                </span>';
       case "expired":
       return  '<span class="pull-right"><div><label for="danger" class="btn btn-danger removeHover">Expired</label></div>';
       case "cancelled":
       return '<span class="pull-right"><div><label for="danger" class="btn btn-danger removeHover">Cancelled</label></div>';
       case "unfinished":
       return '<span class="pull-right"><div><label for="danger" class="btn btn-danger removeHover">Unfinished</label></div>';
       case "complete":
       $creatorView = '<div class="row"><span class=""><div class="col-sm-6"><br><label class="btn btn-success removeHover">Complete</label></div></span>';
       if($task->get_score() == 0){
         $creatorView .= '<div class="col-sm-6">
                <form method="post">
                   <span class="">
                     <div class="">Review the task claimer</div>
                       <button  type="submit" name="reviewHappy" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-thumbs-up"></i>Happy</button>
                       <button  type="submit" name="reviewUnHappy" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-thumbs-down"></i> Not Happy</button>
                     </div>
                     </form>';
       }
       $creatorView .= '</div>';

       return $creatorView;
       default:
       return '';
     }

   }

   public static function createClaimerView($task){
     if(!is_null($task)){
     $claimerView = "";
     if($task->get_status()->get_name() == "complete"){
       $claimerView = '

         <form method="post">
           <div class="row">
               <div class="col-sm-6 pull-left">
                   <div><label class="btn btn-success removeHover">Complete</label></div>
              </div>
               <div class="col-sm-6 pull-right">
                  <div><label class="btn btn-primary removeHover">Review: ';

                  switch($task->get_score()){
                    case 0:
                    $claimerView .= ("Not Yet Reviewed");
                    break;
                    case -5:
                    $claimerView .= "Not Happy";
                    break;
                    case 5:
                    $claimerView .= "Happy";
                    break;
                  }
                  $claimerView .= '
                  </label></div>
              </div>
           </div>
        </form>';
     }else if($task->get_status()->get_name() == "unfinished"){
        $claimerView = '<span class="pull-right">
                   <div>
                     <label class="btn btn-danger removeHover">Unfinished</label>
                   </div>
                 </span>';

   }else if($task->get_status()->get_name() == "cancelled"){
      $claimerView = '<span class="pull-right">
                 <div>
                   <label class="btn btn-danger removeHover">Cancelled</label>
                 </div>
               </span>';

 }else{
         $claimerView = '
        <form method="post">
           <div class="row">
             <div class="col-sm-12 pull-left">
               <button  type="submit" name="taskComplete" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-check"></i>Mark Task as Complete</button>
               <button  type="submit" name="taskCancelled" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i> Mark Task as Cancelled</button>
               </div>
             </div>
           </form>';
         }
         return $claimerView;
       }else{
         return '<div class="text-center">There was an error viewing this task. If the issue persists please contact the system administrator.';
       }
   }

   public static function createBannedView(){
     return '<h3 class="text-danger text-center"> <i class="glyphicon glyphicon-flag"> </i>This user has been banned. This is task is no longer valid. </h3>
     <form method="post" role="form">
       <button type="submit" name="removeBannedTask" class="btn btn-sm btn-danger center-block">Remove Task</button>
     </form>';
   }

   public static function createFlaggedView(){
     return '      <span class="pull-right">
                     <form method="post">
                       <button  type="submit" name="removeFlag" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-check"></i>Remove from Flagged Tasks</button>
                       <button  type="submit" name="banUser" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-flag"></i> Ban User</button>
                     </form>
                   </span>
               <br/><br>
             ';
   }

   public static function createPotentialClaimerView(){
     return '<div class="col-sm-12">
                 <span class="pull-left">
                    <a class="btn btn-default" href="availabletasks.php"><span class="small">Back </span> <span class="small hidden-xs"> to Available Tasks</span></a>
                  </span>
                   <span class="pull-right">
                     <form method="post" role="form">
                       <button type="submit" name="claimTask" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-check"></i>Claim Task</button>
                       <button type="submit" name="flagTask" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-flag"></i> Flag Task</button>
                     </form>
                   </span>

           </div>';
   }


 }

?>
