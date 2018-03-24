<?php
	$host = gethostname();
	$localhost = false;
	$testXF = false;

	if($host == "WolverinDEV")
	    $localhost = true;

	if(!$localhost || $testXF){
		if(file_exists('auth.php'))
			include_once('auth.php');
		else if(file_exists('auth/auth.php'))
			include_once('auth/auth.php');
		else die("Could not resolve auth.php!");
		redirectOnInvalidSession();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>TeaSpeak-Web</title>

        <link rel="stylesheet" href="css/ts/tab.css" type="text/css">
        <link rel="stylesheet" href="css/ts/chat.css" type="text/css">
        <link rel="stylesheet" href="css/ts/client.css" type="text/css">
        <link rel="stylesheet" href="css/ts/icons.css" type="text/css">
        <link rel="stylesheet" href="css/general.css" type="text/css">

        <!-- PHP generated properies -->
        <x-properties id="properties">
            <!-- <x-property key="" value=""/> -->
            <?php
                if($localhost) {
                    echo '<x-property key="connect_default_host" value="localhost"/>';
                } else {
					echo '<x-property key="connect_default_host" value="ts.TeaSpeak.de"/>';
                }
            ?>
        </x-properties>
    </head>
    <body>
        <!-- No javascript error -->
        <div style="display: block; position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; background-color: gray; z-index: 1000; text-align: center;" class="no-js">
            <div style="position: relative; display: inline-block; top: 30%">
                <img src="img/script.svg" height="128px">
                <h1>Please enable JavaScript</h1>
                <h3>TeaSpeak web could not run without it!</h3>
                <h3>Its like you, without coffee</h3>
            </div>
        </div>
        <script type="text/javascript" class="no-js">
            let elements = document.getElementsByClassName("no-js");
            while(elements.length > 0) //Removing these elements (even self)
                elements.item(0).remove();
        </script>

        <!-- Critical load error -->
        <div style="display: none; position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; background-color: gray; z-index: 1000; text-align: center;" id="critical-load">
            <div style="position: relative; display: inline-block; top: 30%">
                <img src="img/script.svg" height="128px">
                <h1 style="color: red">Got some trouble while loading important files!</h1>
                <h3 class="detail"></h3>
            </div>
        </div>

        <!-- -->
        TeaSpeak-Web<br>

        <div style="width: 1200px; height: 900px; display: flex; flex-direction: column; resize: both; margin: 20px"> <!-- Container -->
            <div style="height: 45px; width: 100%; border-radius: 2px 0px 0px 0px; border-bottom-width: 0px; background-color: lightgrey" class="main_container">
                <div id="control_bar" class="control_bar">
                    <div class="button btn_connect"><div class="icon_x32 client-connect"></div></div>
                    <div style="border-left:2px solid gray;height: auto; margin-left: 5px; margin-right: 5px"></div>
                    <div class="button btn_client_away"><div class="icon_x32 client-away"></div></div>
                    <div class="button btn_mute_input"><div class="icon_x32 client-input_muted"></div></div>
                    <div class="button btn_mute_output"><div class="icon_x32 client-output_muted"></div></div>
                    <div style="width: 100%"></div>
                    <div class="button btn_open_settings"><div class="icon_x32 client-settings"></div></div>
                </div>
            </div>

            <div style="flex-direction: row; height: 100%; width: 100%; display: flex">
                <div style="width: 60%; flex-direction: column;">
                    <div style="height: 60%; border-radius: 0px 0px 0px 0px; border-right-width: 0px; overflow: auto; overflow-x: visible" class="main_container">
                        <div class="channelTree" id="channelTree">
                            <div class="server l"><div class="icon client-server_green"></div> TeaSpeak web!</div>
                        </div>
                    </div> <!-- Channel tree -->
                    <div style="height: 40%; border-radius: 0px 0px 0px 2px; border-top-width: 0px; border-right-width: 0px;" class="main_container">
                        <div id="chat">
                            <div class="messages">
                                <div class="message_box"></div>
                            </div>
                            <div class="chats"></div>
                            <div class="input">
                                <!--<div contentEditable="true" class="input_box"></div>-->
                                <textarea class="input_box" title=""></textarea>
                                <button>Send</button>
                            </div>
                        </div>
                    </div> <!-- Chat window -->
                </div>
                <div style="width: 40%; border-radius: 0px 0px 2px 0px;" class="main_container">
                    <div id="select_info" class="select_info">
                    </div>
                </div> <!-- Selection info -->
            </div>
        </div>
        <div id="contextMenu" class="contextMenu"></div>

        <div id="templates"></div>
        <div id="scripts">
            <script src="js/load.js"></script>
        </div>
    </body>
</html>