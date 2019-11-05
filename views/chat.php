<body class="skin-blue">
	<div class="container">
    	<div class="row blue-border-main">
    <!-- header logo: style can be found in header.less -->
    <?php require_once($_SESSION['APP_PATH']."views/header.php");?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?php //require_once($_SESSION['APP_PATH']."views/left_part.php");?>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side strech">
            

            <!-- Main content -->
            <section class="content container">
                <!-- MAILBOX BEGIN -->
                <div class="mailbox row">
                    <div class="col-xs-12">
                        <div class="box box-solid">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-3 col-sm-4">
                                        <!-- BOXES are complex enough to move the .box-header around.
                                             This is an example of having the box header within the box body -->
                                        <div class="box-header">
                                            <i class="fa fa-inbox"></i>
                                            <h3 class="box-title">Messages</h3>
                                        </div>
                                        <!-- Navigation - folders-->
                                        <div style="margin-top: 15px;">
                                            <?php $chatlist = $controller_class -> getAllChatList();
                                            if($chatlist):?>
                                                <ul class="nav nav-pills nav-stacked">
                                                <?php foreach ($chatlist as $k => $chatdata):
                                                    $senderName = $controller_class -> getUserNameFromId($chatdata['senderid']);
                                                    $receiverName = $controller_class -> getUserNameFromId($chatdata['receiverid']);
                                                    $senderorreceiver = $chatdata['senderorreceiver'];
                                                    $chat_invite = $chatdata['chat_invite'];?>
                                                    <?php if($senderorreceiver == 1):?>
                                                    <li class="chatlicls" id="chatli<?php echo $chatdata['id']; ?>">
                                                        <?php if($chat_invite == 1): ?>
                                                        	<a href="javascript:void(0)" onClick="openChatDetail('<?php echo $chatdata['id']; ?>')">
                                                        <?php else: ?>
                                                        	<a href="#inline-pop-chat-invitation-pending" class="fancybox" id="chat-invitation-pending-popup"> 
                                                        <?php endif; ?>
                                                            <i class="fa fa-comments-o"></i> 
                                                            <?php echo $receiverName; ?>
                                                        </a>
                                                    </li>
                                                    <?php else: ?>
                                                    <li class="chatlicls" id="chatli<?php echo $chatdata['id']; ?>">
                                                        <?php if($chat_invite == 1): ?>
                                                         <a href="javascript:void(0)" onClick="openChatDetail('<?php echo $chatdata['id']; ?>')">
                                                        <?php else: ?>
                                                         <a href="javascript:void(0)" onClick="acceptChatInvitationPopup('<?php echo $chatdata['id']; ?>')" >
                                                        <?php endif; ?>
                                                            <i class="fa fa-comments-o"></i> 
                                                            <?php echo $senderName; ?>
                                                        </a>
                                                    </li>
                                                    <?php endif; ?>
                                                <?php endforeach;?>
                                                </ul>
                                            <?php else: ?>
                                                <div class="callout callout-danger">
                                                    <h4>No Messages Found.</h4>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div><!-- /.col (LEFT) -->
                                    <div class="col-md-9 col-sm-8">
                                        
                                        <!-- Chat box -->
                                        <div class="box box-success">
                                            <div class="box-header">
                                                <h3 class="box-title"><i class="fa fa-comments-o"></i> Chat</h3>
                                            </div>
                                            <div class="callout callout-danger" id="noChatMsg">
                                                <h4>No Messages Selected.</h4>
                                            </div>
                                            <div id="chatBoxContent"></div>
                                        </div><!-- /.box (chat box) -->
                                    </div><!-- /.col (RIGHT) -->
                                </div><!-- /.row -->
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col (MAIN) -->
                </div>
                <!-- MAILBOX END -->

            </section><!-- /.content -->
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <?php include('footernew.php'); ?>
    </div>
    </div>
    
    
    <!-- AdminLTE App -->
    <script src="<?php echo $_SESSION['FRNT_DOMAIN_NAME'];?>js/AdminLTE/app.js" type="text/javascript"></script>

</body>