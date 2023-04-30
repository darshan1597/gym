<?php

    function exercises($connection){
        $output = '<option value="">View</option>
            <option value="walking">Walking</option>
            <option value="yoga">Yoga</option>
            <option value="running">Running</option>
            <option value="pushUps">Push Ups</option>
            <option value="lunge">Lunge</option>
            <option value="taiChi">Tai Chi</option>
            <option value="cycling">Cycling</option>
            <option value="jumpRope">Jump Rope</option>
            <option value="dancing">Dancing</option>
            <option value="swimming">Swinning</option>
        ';
        return $output;
    }

    function completion($connection){
        $output = '<option value="">View</option>
            <option value="completed">Completed</option>
            <option value="moderate">Moderate</option>
            <option value="nope">Not Done</option>
        ';
        return $output;
    }

    function exe($connection, $exe){
        if($exe == 'running'){
            echo '
                <ul>
                    <li><span style="font-weight:bold">Burns calories:</span> Running is an excellent way to burn calories and lose weight, as it is a high-intensity exercise that can help you burn a lot of calories in a short amount of time.</li>
                    <li><span style="font-weight:bold">Boosts mood:</span> Running can boost mood and reduce stress and anxiety. It can also improve mental clarity and help you feel more focused and energized.</li>
                    <li><span style="font-weight:bold">Improves sleep quality:</span> Running can improve sleep quality and help you fall asleep faster and stay asleep longer.</li>
                    <li><span style="font-weight:bold">Builds strength and endurance:</span> Running can help build strength and endurance in the muscles, bones, and joints.</li>
                </ul>
            ';
        }
        if($exe == 'walking'){
            echo '
                <ul>
                    <li><span style="font-weight:bold">Helps with weight loss:</span> Walking is an excellent way to burn calories and can aid in weight loss, especially when combined with a healthy diet.</li>
                    <li><span style="font-weight:bold">Boosts mood:</span> Walking can boost mood and reduce stress and anxiety. It can also improve mental clarity and help you feel more focused and energized.</li>
                    <li><span style="font-weight:bold">Reduces joint pain:</span> Walking can help reduce joint pain and stiffness, especially in people with arthritis.</li>
                    <li><span style="font-weight:bold">Enhances overall fitness:</span> Walking can enhance overall fitness levels, improve muscle strength and endurance, and increase flexibility and range of motion.</li>
                </ul>
            ';
        }
        if($exe == 'yoga'){
            echo '
                <ul>
                    <li><span style="font-weight:bold"> Improves flexibility and balance:</span>Yoga poses help to stretch and lengthen muscles, which can improve flexibility and balance.</li>
                    <li><span style="font-weight:bold">Reduces stress and anxiety:</span> Yoga practice includes meditation and breathing exercises that help to calm the mind and reduce stress and anxiety.</li>
                    <li><span style="font-weight:bold">Enhances mental clarity and focus:</span> The mindfulness aspect of yoga can help to improve mental clarity, focus, and concentration.</li>
                    <li><span style="font-weight:bold">Increases self-awareness and self-confidence:</span> Yoga practice can help to increase self-awareness and self-confidence by promoting a sense of inner peace and calm.</li>
                </ul>
            ';
        }
        if($exe == 'pushUps'){
            echo '
                <ul>
                    <li><span style="font-weight:bold">Strengthens chest and arm muscles:</span> Push-ups primarily work the muscles in the chest, shoulders, and arms, including the triceps, biceps, and deltoids.</li>
                    <li><span style="font-weight:bold">Requires no equipment:</span> Push-ups are a convenient exercise that can be done anywhere, anytime, without the need for any equipment.</li>
                    <li><span style="font-weight:bold">Boosts metabolism:</span> Push-ups are a high-intensity exercise that can help to boost metabolism and burn calories.</li>
                    <li><span style="font-weight:bold">Increases bone density:</span> Weight-bearing exercises like push-ups can help to increase bone density, which can reduce the risk of osteoporosis.</li>
                </ul>
            ';
        }
        if($exe == 'lunge'){
            echo '
                <ul>
                    <li><span style="font-weight:bold">Strengthens leg muscles:</span> Lunges work the muscles in the legs, including the quadriceps, hamstrings, and glutes, which can help to build leg strength and improve lower body stability.</li>
                    <li><span style="font-weight:bold">Improves balance and coordination:</span> Lunges require balance and coordination, which can improve overall athletic performance and reduce the risk of falls and injuries.</li>
                    <li><span style="font-weight:bold">Improves posture:</span> Lunges can help to improve posture by strengthening the muscles of the lower back and core, which can help to support the spine.</li>
                    <li><span style="font-weight:bold">Increases calorie burn:</span> Lunges are a high-intensity exercise that can help to increase calorie burn and promote weight loss.</li>
                </ul>
            ';
        }
        if($exe == 'cycling'){
            echo '
                <ul>
                    <li><span style="font-weight:bold">Builds lower body strength:</span> Cycling works the muscles in the legs, including the quadriceps, hamstrings, glutes, and calves, which can help to build lower body strength and endurance.</li>
                    <li><span style="font-weight:bold">Reduces stress:</span> Cycling can help to reduce stress and promote relaxation by releasing endorphins, the body\'s natural feel-good chemicals.</li>
                    <li><span style="font-weight:bold">Cycling can help to reduce stress and promote relaxation by releasing endorphins, the body\'s natural feel-good chemicals.</span> Cycling can improve mental well-being by reducing stress, boosting self-esteem, and improving mood.</li>
                    <li><span style="font-weight:bold">Eco-friendly mode of transportation:</span> Cycling is an eco-friendly mode of transportation that can help to reduce carbon emissions and promote sustainability.</li>
                </ul>
            ';
        }
        if($exe == 'jumpRope'){
            echo '
                <ul>
                    <li><span style="font-weight:bold">Burns calories:</span> Jump rope is a high-intensity exercise that can burn a significant amount of calories, making it an effective way to lose weight or maintain a healthy weight.</li>
                    <li><span style="font-weight:bold">Strengthens lower body muscles:</span> Jump rope works the muscles in the legs, including the calves, quadriceps, and hamstrings, which can help to build lower body strength and endurance.</li>
                    <li><span style="font-weight:bold">Enhances bone density:</span> Jump rope is a weight-bearing exercise that can help to increase bone density and reduce the risk of osteoporosis.</li>
                    <li><span style="font-weight:bold">Low-cost and convenient:</span> Jump rope is a low-cost and convenient exercise that can be done anywhere, anytime, without the need for any equipment.</li>
                </ul>
            ';
        }
        if($exe == 'swimming'){
            echo '
                <ul>
                    <li><span style="font-weight:bold">Low-impact exercise:</span> Swimming is a low-impact exercise that is easy on the joints, making it a good option for people with joint pain or injuries.</li>
                    <li><span style="font-weight:bold">Builds muscle strength and endurance:</span> Swimming works the muscles in the arms, shoulders, back, core, and legs, which can help to build muscle strength and endurance.</li>
                    <li><span style="font-weight:bold">Reduces stress and promotes relaxation:</span> Swimming can help to reduce stress and promote relaxation by releasing endorphins, the body\'s natural feel-good chemicals.</li>
                    <li><span style="font-weight:bold">Improves lung capacity:</span> Swimming can improve lung capacity by increasing the amount of oxygen that the body can take in and utilize.</li>
                </ul>
            ';
        }
    }

    function convertData($string, $action = 'encrypt'){
      $encrypt_method = "AES-256-CBC";
      $secret_key = 'ZFH56OIS6RM12IHROPZY87UNQO28';
      $secret_iv = '4td6aftHuS5';
      $key = hash('sha256', $secret_key);
      $iv = substr(hash('sha256', $secret_iv), 0, 16);
      if ($action == 'encrypt'){
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
      } 
      else if ($action == 'decrypt'){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
      }
      return $output;
    }

    function food($connection){
        $output = '<option value="">View</option>
            <option value="chickenCurry">Chicken Curry</option>
            <option value="tandooriChicken">Tandoori Chicken</option>
            <option value="vegetableBiryani">Vegetable Biryani</option>
            <option value="CholeBhature">Chole Bhature</option>
            <option value="SaagPaneer">Saag Paneer</option>
            <option value="NaanBread">Naan Bread</option>
            <option value="MasalaDosa">Masala Dosa</option>
            <option value="ButterChicken">Butter Chicken</option>
            <option value="ChanaMasala">Chana Masala</option>
            <option value="IdliDosa">Idli and Dosa</option>
            <option value=">AlooGobi">Aloo Gobi</option>
            <option value="DalMakhani">Dal Makhani</option>
            <option value="PalakPaneer">Palak Paneer</option>
            <option value="VadaPav">Vada Pav</option>
            <option value="HyderabadiBiryani">Hyderabadi Biryani</option>
            <option value="MutterPaneer">Mutter Paneer</option>
            <option value="PapdiChaat">Papdi Chaat</option>
            <option value="Rasam">Rasam</option>
            <option value="ChickenTikkaMasala">Chicken Tikka Masala</option>
            <option value="DahiVada">Dahi Vada</option>
            <option value="PaneerButterMasala">Paneer Butter Masala</option>
            <option value="ChickenKorma">Chicken Korma</option>
            <option value="AlooTikki">Aloo Tikki</option>
        ';
        return $output;        
    }

?>