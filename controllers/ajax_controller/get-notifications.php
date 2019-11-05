<?php
@session_start();
error_reporting(0);
include('../../models/db.php');
include('../../models/common-model.php');
include('../../includes/thumb_new.php');
include('../../includes/resize-class.php');
include('../common-controller.php');
$database = new Connection();
include('../../models/ajax-model.php');
$modelObj = new AjaxModel();
$commoncont = new CommonController();
if (isset($_POST)) {
    $response['status'] = false;
    $id = $_POST['id'];
    $uid = $_SESSION['po_userses']['flc_usrlogin_id'];
    $qry = "SELECT tbl_notification.*,tbl_users.username,tbl_category.categoryName as categoryname FROM tbl_notification LEFT JOIN tbl_users on tbl_notification.requesteduser = tbl_users.id LEFT JOIN tbl_category on tbl_notification.objectcat = tbl_category.id where tbl_notification.userid =$uid AND tbl_notification.id= $id";
    $result = $modelObj->fetchRows($qry);
    if (!empty($result)) {
        $qryUpdate = "UPDATE tbl_notification SET status='0' WHERE id = " . $result[0]['id'];
        $modelObj->runQuery($qryUpdate);
        $response['status'] = true;

        $allbid = '';
        if ($result[0]['type'] == 'bid') {
            $allbid = '<p>View All : <a target="_blank" href="' . $_SESSION['FRNT_DOMAIN_NAME'] . 'biddetail/?imageid=' . $result[0]['objectid'] . '">Click Here</a></p>';
        } else if ($result[0]['type'] == 'access') {
            $allbid = '<p>View All Requests : <a target="_blank" href="' . $_SESSION['FRNT_DOMAIN_NAME'] . 'accessdetail/?aid=' . $result[0]['objectid'] . '">Click Here</a></p>';
        } else if ($result[0]['type'] == 'company_noti') {
            $allbid = '<p>See All Requests : <a target="_blank" href="' . $_SESSION['FRNT_DOMAIN_NAME'] . 'accessdetail/?compnoti=' . $result[0]['objectid'] . '">Click Here</a></p>';
        }
        //die;exit;

        $requesteduser = '<a target="_blank" href="' . $_SESSION['FRNT_DOMAIN_NAME'] . 'artistpreview/' . $result[0]['username'] . '"><p>' . $result[0]['name'] . ',</p></a>';
        $response['nothtml'] = '<h2>
                                    <span class="icon icon-star-large"></span> ' . $result[0]['subject'] . ' <span class="icon icon-reply-large"></span><span class="icon icon-delete-large"></span>
                                </h2>
                                <div class="meta-data">
                                    <p>
                                        <img src="http://placehold.it/40x40" class="avatar" alt="" />
                                        ' . $result[0]['name'] . ' to <span class="user">me</span>
                                        <span class="date">' . date('M d, Y', strtotime($result[0]['cr_date'])) . '</span>
                                    </p>
                                </div>
                                <div class="body">
                                    ' . $requesteduser . '
                                    <p>' . $result[0]['message'] . '</p>
                                    <p>' . $result[0]['categoryname'] . '</p>
                                    ' . $allbid . '
                                    <p>Cheers</p>
                                </div>';
        //$response['subject'] = $result[0]['subject'];
    }
    echo json_encode($response);
}
?>