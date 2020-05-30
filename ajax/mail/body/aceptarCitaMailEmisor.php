<?php 

$dateInMail = date("F j, Y"); 

$subject = ' Cita con '.$nombreReceptor.' confirmada!';

$body = '<html>

<head>

  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
  <title>vince</title>

  <style type="text/css">
    * {
      margin-top: 0px;
      margin-bottom: 0px;
      padding: 0px;
      border: none;
      line-height: normal;
      outline: none;
      list-style: none;
      -webkit-text-size-adjust: none;
      -ms-text-size-adjust: none;
    }

    table {
      border-collapse: collapse !important;
      padding: 0px !important;
      border: none !important;
      border-bottom-width: 0px !important;
    }

    table td {
      border-collapse: collapse;
      text-decoration: none;
    }

    body {
      margin: 0px;
      padding: 0px;
      background-color: #f3f3f3;
    }

    .ExternalClass * {
      line-height: 100%;
    }


    @media only screen and (max-width:640px) {
      body {
        width: auto !important;
      }

      table [class=main] {
        width: 85% !important;
      }

      table [class=full] {
        width: 100% !important;
        margin: 0px auto;
      }

      table [class=two-left-inner] {
        width: 90% !important;
        margin: 0px auto;
      }

      td[class="two-left"] {
        display: block;
        width: 100% !important;
      }

      table [class=menu-icon] {
        display: none;
      }

      img[class="image-full"] {
        width: 100% !important;
      }

      table[class=menu-icon] {
        display: none;
      }

    }

    @media only screen and (max-width:479px) {
      body {
        width: auto !important;
      }

      table [class=main] {
        width: 93% !important;
      }

      table [class=full] {
        width: 100% !important;
        margin: 0px auto;
      }

      td[class="two-left"] {
        display: block;
        width: 100% !important;
      }

      table [class=two-left-inner] {
        width: 90% !important;
        margin: 0px auto;
      }

      table [class=menu-icon] {
        display: none;
      }

      img[class="image-full"] {
        width: 100% !important;
      }

      table[class=menu-icon] {
        display: none;
      }

    }
  </style>

</head>

<body yahoo="fix" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

  <!--Main Table Start-->

  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tbody>
      <tr>
        <td align="center" valign="top" bgcolor="#f3f3f3" style="background:#f3f3f3; padding:40px 0px;">


          <!--Top Space Part Start-->

          <table style="width:100%!important" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
            <tbody>
              <tr>
                <td align="center" valign="top" bgcolor="#FFFFFF" style="background:#FFF;">
                  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left-inner">
                    <tbody>
                      <tr>
                        <td align="left" valign="top" style="line-height:50px; line-height:50px;">&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>

          <!--Top Space Part End-->

          <!--Logo Part Start-->

          <table style="width:100%!important" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
            <tbody>
              <tr>
                <td align="center" valign="top" bgcolor="#FFFFFF" style="background:#FFF;">
                  <table width="675" border="0" align="right" cellpadding="0" cellspacing="0" class="two-left-inner">
                    <tbody>
                      <tr>
                        <td width="50%" align="left" valign="top" class="two-left">
                          <table border="0" align="left" cellpadding="0" cellspacing="0">
                            <tbody>
                              <tr>
                                <td align="center" valign="top"><a href="#"><img
                                      src="https://renoca.ml/work/circulovip/images/logo.png"  width="180"
                                      height="90" alt=""></a></td>
                              </tr>
                              <tr>
                                <td align="center" valign="top">&nbsp;</td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                        <td width="50%" align="right" valign="top" class="two-left">
                          <table width="110" border="0" align="right" cellpadding="0" cellspacing="0">
                            <tbody>
                              <tr>
                                <td height="35" align="center" valign="middle" bgcolor="#530779"
                                  style="font-family:Open Sans, sans-serif, Verdana; font-size:14px; font-weight:bold; color:#FFF;">
                                  '.$dateInMail.'</td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>

          <!--Logo Part End-->

          <!--Menu Part Start-->

          <table style="width:100%!important" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
            <tbody>
              <tr>
                <td align="center" valign="top" bgcolor="#FFFFFF" style="background:#FFF;">
                  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left-inner">
                    <tbody>
                                        
                      <tr>
                        <td align="center" valign="top">
                          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                              <tr>
                                <td align="center" valign="top">&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="left" valign="top"
                                  style="font-family:Open Sans,
                                   sans-serif, Verdana; font-size:22px;
                                    font-weight:bold; color:#222222;">
                                  '.$nombreReceptor.'! Ha aceptado la cita!<br><br>
        
                                  Ingrese a la<a href="https://plataformacirculovip.com/socio/sala_de_espera.php"
                                   target="_blank">Sala de espera</a> 
                                   y 3 minutos antes de la cita<br> sera redireccionado automaticamente<br><br>
                          
                                  Cita agendada para '.$fechaDeCita.'
                          </td>
                              </tr>
                              <tr>
                                <td height="5" align="center" valign="top" style="font-size:5px; line-height:5px;">
                                  &nbsp;</td>
                              </tr>
                              <tr>
                                <td height="20" align="center" valign="top">&nbsp;</td>
                              </tr>

                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" style="line-height:70px; line-height:70px;">&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>

          <!--Menu Part End-->
          <!--Footer Text Part Start-->

          <table style="width:100%!important" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
            <tbody>
              <tr>
                <td align="center" valign="top" bgcolor="#222" data-bgcolor="gray-bg">
                  <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
                    <tbody>
                      <tr>
                        <td height="35" align="center" valign="top" style="font-size:65px; line-height:65px;">&nbsp;
                        </td>
                      </tr>
                      <tr>
                        <td align="center" valign="top">
                          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                              <tr>
                                <td width="375" align="center" valign="top" class="two-left">
                                  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                                    <tbody>
                                      <tr>
                                        <td align="left" valign="top"
                                          style="font-family:Roboto, Open Sans; font-size:28px; color:#FFF; line-height:38px; font-weight:normal;">
                                          Contactenos</td>
                                      </tr>
                                      <tr>
                                        <td height="10" align="left" valign="top"
                                          style="font-size:10px; line-height:10px;">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td height="25" align="left" valign="top"
                                          style="font-size:25px; line-height:25px;">&nbsp;</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                                <td width="375" align="center" valign="top" class="two-left">
                                  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                                    <tbody>
                                      <tr>
                                        <td align="left" valign="top" style="display:none"
                                          style="font-family:Open Sans, sans-serif, Verdana; font-size:13px; color:#FFF; line-height:26px; font-weight:normal;">
                                          vince Compus,<br>
                                          Stvide street,Lintion view,
                                          Austria.</td>
                                      </tr>
                                      <tr>
                                        <td height="5" align="left" valign="top"
                                          style="font-size:5px; line-height:5px;">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td align="center" valign="top"
                                          style="font-family:Roboto, Open Sans; font-size:24px; color:#FFF; line-height:38px; font-weight:normal;">
                                          +598 95691780  </td>
                                      </tr>
                                      <tr>
                                        <td align="center" valign="top"
                                          style="font-family:Roboto, Open Sans; font-size:18px; color:#FFF; line-height:30px; font-weight:normal;">
                                          circulovipempresarial@gmail.com</td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top">&nbsp;</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                                <td width="120" align="left" valign="top" class="two-left">
                                  <table width="100%" border="0" align="left" style="display:none" cellpadding="0" cellspacing="0">
                                    <tbody>
                                      <tr>
                                        <td align="left" valign="top"
                                          style="font-family:Open Sans, sans-serif, Verdana; font-size:15px; color:#FFF; line-height:32px; font-weight:bold;">
                                          <a href="#" style="text-decoration:none; color:#FFF;">Home</a><br>
                                          <a href="#" style="text-decoration:none; color:#FFF;">About us</a><br>
                                          <a href="#" style="text-decoration:none; color:#FFF;">Services</a><br>
                                          <a href="#" style="text-decoration:none; color:#FFF;">Contact us</a></td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top">&nbsp;</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td height="35" align="center" valign="top" style="font-size:75px; line-height:75px;">&nbsp;
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>

          <!--Footer Text Part End-->

          <!--Copyright Part Start-->

          <table style="width:100%!important" border="0" align="center" cellpadding="0" cellspacing="0" class="full">
            <tbody>
              <tr>
                <td align="center" valign="top" bgcolor="#FFFFFF">
                  <table width="670" border="0" align="center" cellpadding="0" cellspacing="0" class="two-left-inner">
                    <tbody>
                      <tr>
                        <td height="20" colspan="2" align="left" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="100%" align="center" valign="top" class="two-left">
                          <table border="0" cellspacing="0" cellpadding="0" class="full">
                            <tbody>
                              <tr>
                                <td align="center" valign="top"
                                  style="font-family:Open Sans, sans-serif, Verdana; font-size:14px; color:#6a7489; font-weight:normal;">
                                  Copyright © circulovip.com. All Rights Reserved.</td>
                              </tr>
                            </tbody>
                          </table>
                        </td>

                      </tr>
                      <tr>
                        <td height="20" colspan="2" align="left" valign="top">&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>

          <!--Copyright Part End-->

        </td>
      </tr>
    </tbody>
  </table>

  <!--Main Table End-->
</body>

</html>';

