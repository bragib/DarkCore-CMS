<?php define('DarkCoreCMS', TRUE); include 'header.php'; if (isset($_SESSION['usr'])) { $user_prw = $_SESSION['usr'];}
    if (isset($_POST['login']))
        do_login($_POST['login_username'],$_POST['login_password']);
    if (isset($_GET["errlogin"])){?>
        <div id="notify">There was an error when logging in recheck your account and password corectly acc and pass are case sensitive</div>
    <?php } ?>
	<div id='content'>
		<div id='index-content-left'>
			<div id='main-tools'>
				<div class='main-tools-box'>
                    <h1 class="main-tools-head-text">Здравствуйте <?php echo strtoupper($website_title) ?></h1>
                    <div class="main-tools-description"><?php echo $website_description ?></div>
                    <ul>
                        <li class="main-tools-li"><a href="armory.php">Армори</a></li>
                        <li class="main-tools-li"><a href="guides.php">Начать играть</a></li>
                        <li class="main-tools-li"><a href="rules.php">Правила</a></li>
                    </ul>
				</div>
			</div>
			<div id='lastnews'>
			<?php $data_news = new TopicsData; $data_news->construct_index()?>
				<div class='lastnews-head-text'>Новости</div>
                <div class="newsdivider"></div>
				<div class='newsthumb'>
					<div class='newsthumbicon'><img src='<?php echo get_avatar_byid($data_news->last_topic_index['autor']);?>' alt='<?php echo $data_news->last_topic_index['title'];?>' width="100%" height="100%"/></div>
					<div class='newsthumbbody'>
						<div class='newsthumbtitle'><?php echo $data_news->last_topic_index['title'];?></div>
						<div class='newsthumbresult'>&emsp;&emsp;<?php echo strip_tags(substr($data_news->last_topic_index['body'], 0, 300)); ?>...</div>
						<div class='newsthumbbutton'>
							<div class='thb-left'>
								<label style='color:#72BF8B;'>Опубликовал</label> <a href="../user.php?id=<?php echo $data_news->last_topic_index['autor']; ?>"><label style='font-size:14px !important;color:#<?php echo namecolor(get_rank_byid($data_news->last_topic_index['autor']),get_vip_byid($data_news->last_topic_index['autor'])); ?>;'><?php echo ucfirst(strtolower(get_username_byid($data_news->last_topic_index['autor']))); ?></label></a>
								<label style='color:#72BF8B;'> <?php echo substr($data_news->last_topic_index['date'],0,10); ?> </label>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div id='mediabox'>
				<div class='mediabox-head-text'>Видео</div>
                <div class="newsdivider"></div>
                <iframe id="abc_frame" width="368" height="215" src="https://www.youtube.com/embed/iyQ0dXWmW6o" frameborder="0" allowfullscreen></iframe>
                <div class="media-line">
                    <div class="media-thumb" onclick="getvideo('iyQ0dXWmW6o')">
                        <img src="http://img.youtube.com/vi/iyQ0dXWmW6o/2.jpg" width="50" height="50" />
                    </div>
                    <div class="media-thumb" onclick="getvideo('vRYvhY8YzU4')" style="margin-left:10px;">
                        <img src="http://img.youtube.com/vi/vRYvhY8YzU4/2.jpg" width="50" height="50" />
                    </div>
                </div>
			</div>
            <div id='secondary-box'>
                <div class='mediabox-head-text'>Социальная сеть </div>
                <div class="newsdivider"></div>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>

<!-- VK Widget -->
<div id="vk_groups"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 0, width: "288", height: "282", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 33385459);
</script>
            </div>
		</div>
        <div id='index-content-right'>
            <div class='acclogin-info'>
                <div class='acclogin-info-head-text'>Аккаунт <?php if (isset($user_prw)){echo "- <a href='user.php' class='accnamelink'>".strtoupper($user_prw)."</a>";}; ?></div>
                <div class="newsdivider"></div>
                <div class='loggedas'>
                <?php if (!isset($_SESSION['usr'])) {?>
					<form action='' method='post'  autocomplete='off' enctype='multipart/form-data'>
                        <input style="display:none">
                        <input type="password.php" style="display:none">
                        <input value=''  name='login_username' class='usrinput' placeholder="Username" autocomplete="off" type='text' />
						<input value=''  name='login_password' class='usrinput' style="margin-top:5px;" placeholder="Password" autocomplete="off" type='password' />
						<input value='Login.php' name='login' id='submit' type='submit'>
                        <a href='register.php' /><div class='submit-submenu'>Регистрация</div></a>
                    </form>

				<?php } else { $user_account->construct(ucfirst($user_prw));?>
					<div id='inforow' class="skinnytip" data-text="<div class='miniinfo'>This field represent your registrar email</div>">
						<div class='inforowdesc'>Email:</div>
						<div class='inforowresult'><?php echo $user_account->email; ?></div>
					</div>
					<div id='inforow' class="skinnytip" data-text="<div class='miniinfo'>This field represent the last time when you logged ingame</div>">
						<div class='inforowdesc'>Session:</div>
						<div class='inforowresult'><?php echo $user_account->last_login; ?></div>
					</div>
					<div id='inforow' class="skinnytip" data-text="<div class='miniinfo'>This field represent your last login IP</div>">
						<div class='inforowdesc'>Last IP:</div>
						<div class='inforowresult'><?php echo $user_account->last_ip; ?></div>
					</div>
					<div id='inforow' class="skinnytip" data-text="<div class='miniinfo'>This field represent your rank</div>">
						<div class='inforowdesc'>Rank:</div>
						<div class='inforowresult' style='color:#<?php echo namecolor($user_account->gmlevel,$user_account->VipLevel) ?>'><?php echo strtoupper(rankstring($user_account->gmlevel,$user_account->VipLevel)); ?></div>
					</div>
					<div id='inforow' class="skinnytip" data-text="<div class='miniinfo'>This represent your total Vote Points</div>">
						<div class='inforowdesc'>Vote Points:</div>
						<div class='inforowresult'><?php echo $user_account->vp; ?></div>
					</div>
					<div id='inforow' class="skinnytip" data-text="<div class='miniinfo'>This represent your total Donation Points</div>">
						<div class='inforowdesc'>Donation Points:</div>
						<div class='inforowresult'><?php echo $user_account->dp; ?></div>
					</div>
				<?php } ?>
                    </div>
            </div>
            <div class="connectionguide"></div>
            <div class="dpatches"></div>
            <div class="rmlist"><?php echo $realmlist ?></div>
            <?php $realminfo = new realm;
            $realminfo->construct(1);?>
            <div class="realmstat">
                <a href="realm?id=<?php echo $realminfo->realm_id;?>">
                    <img class="gversion" src='images/r-wod.png' height='19' alt='username'><div class="realmname"><a href="realm.php?realm=1/<?php echo urlencode($realminfo->rm_name); ?>" class="realmnamelink"><?php echo $realminfo->rm_name; ?></a></div>
                    <div class="realminfo">Онлайн: <?php echo $realminfo->total_online;?>
                    Alliance: <?php echo $realminfo->alliance;?> Horde: <?php echo $realminfo->horde;?></div>
                </a>
            </div>
        </div>
	</div>
    <script>
        function getvideo($code){
            $(document).ready(function() {
                $('#abc_frame').attr('src','https://www.youtube.com/embed/'+$code);
            })
        }
    </script>
<script type="text/javascript">SkinnyTip.init();</script>
</body>
<?php include 'global-footer.php' ?>
</html>