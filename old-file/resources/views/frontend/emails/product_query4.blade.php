<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
  <head>
    <link rel="icon" href="http://aticoindia.com/assets/frontend/images/logo.png" type="image/png">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width">
    <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">
    <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Product Query</title>
  </head>
  <body style="margin: 0; mso-line-height-rule: exactly; margin-top: 50px !important; margin-bottom: 50px !important;">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
    <style>
      html, body {
      font-family: 'Open Sans', sans-serif;
      }
    </style>
    <center style="width: 100%; text-align: left;">
      <div style="width:700px; min-height: 300px; margin: 0 auto; background-color:white; background-size: cover; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">
        <div style="width: 99%; height: 100%; border: 4px solid #002c4d; margin: 0 auto;">
          <div class="header-logo" style=" width: 100px; margin: 18px auto 10px auto; overflow: hidden; text-align: center;">
            <a style="margin: 0 auto; display: block; text-align: center;" href="http://aticoindia.com">
              <img style="max-width: 100%; margin: 0 auto; text-align: center;" src="http://aticoindia.com/assets/frontend/images/logo.png">
            </a>
          </div>
          <div style="background-color: #002c4d; padding: 50px 0px; float: left; width: 100%; text-align: center; margin: 0px 0px 0px 0px;">
          
            <h4 style="font-size: 15px; font-weight: normal; line-height: 24px; color: white; text-align: left; padding: 0px 18px;">Thankyou for your Query</h4>

            <h4 style="font-size: 15px; font-weight: normal; color: #f76b2b; padding: 0px 18px; text-align: left; text-align: center; font-weight: 600;">Query DETAILS</h4>

            <div style="padding: 0px 10px;">
              <table style="color: #fff; width: 100%;" cellpadding="0" cellspacing="0">
                <tbody style="font-weight: 600;">
                  <tr style="text-transform: capitalize;">
                    <td style="background-color: #f76b2b; width: 40%; border: 1px solid #e1e1e1; padding: 6px 3px; border-bottom: 0; font-size: 14px;">Name</td>
                    <td style="border: 1px solid #e1e1e1; border-bottom: 0; padding: 10px 10px; font-size: 14px;">{!! $name !!}</td>
                  </tr>

                  <tr style="text-transform: capitalize;">
                    <td style="background-color: #f76b2b; border: 1px solid #e1e1e1; border-bottom: 0; padding: 10px 10px; font-size: 14px;">Email</td>
                    <td style="border: 1px solid #e1e1e1; border-bottom: 0; padding: 10px 10px; font-size: 14px;">{!! $email !!}</td>
                  </tr>   

                  <tr style="text-transform: capitalize;">
                    <td style="background-color: #f76b2b; border: 1px solid #e1e1e1; padding: 6px 3px; font-size: 14px;">Mobile Number</td>
                    <td style="border: 1px solid #e1e1e1; padding: 6px 3px; font-size: 14px;">{!! $phone_number !!}</td>
                  </tr>

                  <tr style="text-transform: capitalize;">
                    <td style="background-color: #f76b2b; border: 1px solid #e1e1e1; padding: 6px 3px; font-size: 14px;">Country</td>
                    <td style="border: 1px solid #e1e1e1; padding: 6px 3px; font-size: 14px;">{!! $country !!}</td>
                  </tr>
                  
                  <tr style="text-transform: capitalize;">
                    <td style="background-color: #f76b2b; border: 1px solid #e1e1e1; padding: 6px 3px; font-size: 14px;">Message</td>
                    <td style="border: 1px solid #e1e1e1; padding: 6px 3px; font-size: 14px;">{{ $massage }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <h4 style="font-size: 15px; font-weight: normal; line-height: 24px; color: white; text-align: left; padding: 0px 18px; margin-bottom: 0px;"> Don’t hesitate to contact us for any questions or concerns.</h4>
            <h4 style="font-size: 15px; font-weight: normal; line-height: 24px; color: white; text-align: left; padding: 0px 18px; margin-bottom: 0px;">Have a great day! </h4>
          </div>         


          <div style="width: 100%; padding: 30px 0px; clear: both; margin: 0 auto;">
            <h4 style="font-size: 15px; margin: 3px 0px; font-weight: 600; padding-left: 18px; color: #002c4d;">Best Regards,</h4>
            <h4 style="font-size: 15px; margin: 3px 0px; font-weight: 600; padding-left: 18px; color: #002c4d;">ATICO INDIA</h4> 
            <h4 style="font-size: 15px; margin: 3px 0px; font-weight: 600; padding-left: 18px; color: #002c4d;">274, Sector 2, Industrial Growth Centre, HSIIDC, SAHA Haryana</h4>
          </div>

          <h4 style="font-size: 14px; margin-bottom: 30px; font-weight: 600; padding-left: 18px; color: #000;">This is an automatically generated email; please do not reply to this message.</h4>

          <div style="width: 100%; text-align: center; border-top: 1px solid gray;">
            <p style="font-weight: 600; font-size: 14px; color: #002c4d;">For any query mail us at 
              <a style="color: #f76b2b;" href="mailto:sales@aticoindia.com" style="font-weight:bold;">sales@aticoindia.com</a>
            </p>
          </div>
        </div>
      </div>
    </center>
  </body>
</html>