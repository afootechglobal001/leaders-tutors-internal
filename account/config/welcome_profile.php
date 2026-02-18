<?php
class allClass
{
    function _UserWelcomeProfile($website_url)
    { ?>
        <div class="the-title-div">
            <h2 class="title-text2">USER PORTAL</h2>
            <span id="page-title"> <i class="bi-speedometer2"></i> Dashboard</span>
            <!-- <br>
            <span id="page-title"> <i class="bi-speedometer2"></i> Dashboard</span> -->

            <div class="user-desc">
                <div class="div-in">

                    <div class="pix-div" id="welcome_pix"><img src="<?php echo $website_url ?>/uploaded_files/user_pix/friends.png" id="passportimg3" alt="Profile image" /></div>

                    <div class="detail user-details">
                        <h3 id="login_user_fullname">Xxxx Xxxx</h3>
                        <span><i class="fa fa-clock-o"></i> Last Login Date </span> - <span id="login_user_login_time">xxxx</span>
                    </div>

                    <div class="amount-div amount1">
                        <div class="price">₦<span id="user_wallet_balance">0.00</span><span id="text_in"></span> <span onclick="_hideAndShowWallet();" id="hide_show" style="font-size:15px"><i class="bi-eye"></i></span></div>
                        <button class="btn" onClick="_getForm('load_user_wallet','load_wallet')" id="load_wallet"><i class="bi bi-wallet2"></i> Load Wallet</button>
                    </div>

                    <div class="amount-div expires-div">
                        <span>Subscription expires in </span>
                        <h3><span id="get_user_remaining_expires_days">0</span> Day(s)</h3>
                    </div>

                </div>
            </div>


            <div class="user-desc mobile-user-desc">
                <div class="div-in">
                    <div class="pix-div mobile-pix-div" id="welcome_pix"><img src="<?php echo $website_url ?>/uploaded_files/user_pix/friends.png" id="passportimg3" alt="Profile image" /></div>

                    <div class="detail mobile-detail">
                        <h3 id="login_user_fullname">Xxxxx Xxxxx</h3>
                        <span><i class="fa fa-clock-o"></i> Last Login Date </span> - <span id="login_user_login_time">xxxx</span>
                    </div>

                    <div class="amount-div mobile-amount">
                        <div class="price mobile-price"><span class="text">Wallet Ballance</span> <span class="text" onclick="_hideAndShowWallet();" id="mobile_hide_show" style="font-size:13px"><i class="bi-eye"></i></span><br /> ₦ <span id="user_mobile_wallet_balance">0.00</span> <span id="mobile_text_in"></span> </div>
                        <button class="btn mobile-btn" onClick="_getForm('load_user_wallet','load_wallet')" id="load_wallet"><i class="bi bi-wallet2"></i> Load Wallet</button>
                    </div>

                </div>
            </div>


        </div>



        <script>
            //_disabledInspect();
        </script>



<?php }
} //end of class
$callclass = new allClass();
?>