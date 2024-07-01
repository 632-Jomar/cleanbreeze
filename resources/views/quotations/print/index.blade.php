<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="2bdye43SKru0Lqe5KA0wcptGB4t18A1ccpuUs9Mm">
        <title>Print Quotation</title>
        <!-- Bootstrap CSS CDN -->
        <!-- <link rel="stylesheet" media="print" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="/quotation-print/print/bootstrap.css">
        <link rel="stylesheet" href="/quotation-print/print/print.css">
        <link rel="stylesheet" href="/quotation-print/print/purchase_order.css">
        <link rel="stylesheet" href="/quotation-print/print/search.css">
        <!-- Our Custom CSS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <!--- JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

        <style>
            *{
            font-size: 14px !important;
            }
            p {
            color: black!important;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="col-lg-12" style="display: inline-flex;width: 100%;padding: 0;">
                <div style="padding: 0;">
                </div>
                <div style="padding: 0;width: 100%;">
                    <div id="dont_print" style="background: #449d44 !important;">
                    </div>
                    <div id="content" class="not_print" style="width: 100%;">
                        <div class="content print">
                            <div style="margin: auto;">
                                <form name="add_item" id="add_item" class="form-inline">
                                    <input type="hidden" name="_token" value="2bdye43SKru0Lqe5KA0wcptGB4t18A1ccpuUs9Mm">
                                    <div>
                                        <div class="col-xs-16">
                                            <div>
                                            </div>
                                            <div class="invoice-title">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <th class="order" style="padding: 10px;background-color: black  !important;">Quote #:</th>
                                                            <td style="padding: 10px;">{{ $quotation->id }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td class="image-print">
                                                                <img src="/quotation-print/printlogo.png" style="width:400px;">
                                                                <center>
                                                                    <table>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th>721 Aurora Blvd. Brgy. Mariana, Quezon City</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Tel: (02)239-8281 Fax: (02)238-4011</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Email: contact@philgeogreen.com</th>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </center>
                                                            </td>
                                                            <td class="title-print">
                                                                <center>
                                                                    <h4>QUOTATION</h4>
                                                                </center>
                                                            </td>
                                                            <td class="title-print">
                                                                <center>
                                                                    <table class="table table-bordered">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="order" style="background-color: black  !important;">
                                                                                    <label>JO Number:</label>
                                                                                </td>
                                                                                <td style="padding: 10px;">
                                                                                    <label>{{ $quotation->jo_number ?? '-' }}</label>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="order" style="background-color: black  !important;">
                                                                                    <label>Location:</label>
                                                                                </td>
                                                                                <td style="padding: 10px;">
                                                                                    <label>{{ $quotation->location ?? '-' }}</label>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="order" style="background-color: black  !important;">
                                                                                    <label>Project:</label>
                                                                                </td>
                                                                                <td style="padding: 10px;">
                                                                                    <label>{{ $quotation->project ?? '-' }}</label>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="order" style="background-color: black  !important;">
                                                                                    <label>Expiration Date:</label>
                                                                                </td>
                                                                                <td style="padding: 10px;">
                                                                                    <label>{{ $quotation->expiration_date }}</label>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div>
                                                <br>
                                                <table class="table table-responsive">
                                                    <tbody>
                                                        <tr class="title" style="background-color: black  !important;">
                                                            <td class="order" colspan="4" style="background-color: black  !important;">
                                                                <label style="font-size: 14px !important;">Client Details:</label>
                                                            </td>
                                                            <td class="order" colspan="4" style="background-color: black  !important;">
                                                                <label style="font-size: 14px !important;">Date: 2024-06-27</label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="1"><label style="font-size: 14px !important;">Name:</label></td>
                                                            <td colspan="3" style="font-size: 14px !important;">Kuroneko Nya~</td>
                                                            <td colspan="1"><label style="font-size: 14px !important;">Contact #:</label></td>
                                                            <td colspan="3" style="font-size: 14px !important;">09458858455</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="1"><label style="font-size: 14px !important;">Email:</label></td>
                                                            <td colspan="3" style="font-size: 14px !important;">jalarcon.632apps@gmail.com</td>
                                                            <td colspan="1"><label style="font-size: 14px !important;">Address:</label></td>
                                                            <td colspan="3" style="font-size: 14px !important;">New Address</td>
                                                        </tr>
                                                        <tr class="title">
                                                            <td class="order" colspan="4" style="background-color: black  !important;">
                                                                <label></label>
                                                            </td>
                                                            <td class="order" colspan="4" style="background-color: black  !important;">
                                                                <label class="pull-right"></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="1"><label style="font-size: 14px !important;">Sales Person:</label></td>
                                                            <td colspan="5" style="font-size: 14px !important;">Aeron(sales Dummy)</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="1"><label style="font-size: 14px !important;">Payment Terms:</label></td>
                                                            <td colspan="5" style="font-size: 14px !important;">50% dp and 50% before delivery</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div style="page-break-before: auto;">
                                                <div class="col-md-14">
                                                    <div class="">
                                                        <div class="panel-heading">
                                                            <div class="">
                                                                <h3 class="panel-title">ITEMS ORDERED</h3>
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" id="po_table">
                                                                    <tbody>
                                                                        <tr class="head" style="background-color: black  !important;">
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;" colspan="7">ITEMS</th>
                                                                        </tr>
                                                                        <tr class="head" style="background-color: black  !important;">
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;">BRAND</th>
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;">PRODUCT</th>
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;" colspan="2">PRODUCT INFORMATION</th>
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;">PRODUCT PRICE</th>
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;">QTY</th>
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;">TOTAL PRICE</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="vertical-align: middle;">
                                                                                <center style="font-size: 14px !important;">
                                                                                    BAF
                                                                                </center>
                                                                            </td>
                                                                            <td style="vertical-align: middle;">
                                                                                <center style="font-size: 14px !important;">
                                                                                    Haiku
                                                                                </center>
                                                                            </td>
                                                                            <td colspan="2">
                                                                                <table class="table table-bordered">
                                                                                    <tbody>
                                                                                        <tr style="background-color: #8c8c8c;">
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">Type</label></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">Diameter</label></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">Color</label></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">Warranty</label></center>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="font-size: 14px !important;">L- Series (Indoor)</td>
                                                                                            <td style="font-size: 14px !important;">52" - Universal - Black/ White</td>
                                                                                            <td style="font-size: 14px !important;">
                                                                                                Black
                                                                                            </td>
                                                                                            <td style="font-size: 14px !important;" rowspan="3">
                                                                                                1 Year
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr style="background-color: #8c8c8c;">
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">Power</label></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">Extension</label></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">LED</label></center>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="font-size: 14px !important;">
                                                                                                N/A
                                                                                            </td>
                                                                                            <td style="font-size: 14px !important;">
                                                                                                N/A
                                                                                            </td>
                                                                                            <td style="font-size: 14px !important;">
                                                                                                N/A
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                            <td style="vertical-align: middle;font-size: 14px !important;">
                                                                                <center>
                                                                                    PHP &nbsp; 50,000.00
                                                                                </center>
                                                                            </td>
                                                                            <td style="vertical-align: middle;font-size: 14px !important;">
                                                                                <center>
                                                                                    1
                                                                                </center>
                                                                            </td>
                                                                            <td style="vertical-align: middle;font-size: 14px !important;">
                                                                                <center>
                                                                                    PHP &nbsp;50,000.00
                                                                                </center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="head" style="background-color: black  !important;">
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;">BRAND</th>
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;">PRODUCT</th>
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;" colspan="2">PRODUCT INFORMATION</th>
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;">PRODUCT PRICE</th>
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;">QTY</th>
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;">TOTAL PRICE</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="vertical-align: middle;">
                                                                                <center style="font-size: 14px !important;">
                                                                                    BAF
                                                                                </center>
                                                                            </td>
                                                                            <td style="vertical-align: middle;">
                                                                                <center style="font-size: 14px !important;">
                                                                                    Haiku
                                                                                </center>
                                                                            </td>
                                                                            <td colspan="2">
                                                                                <table class="table table-bordered">
                                                                                    <tbody>
                                                                                        <tr style="background-color: #8c8c8c;">
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">Type</label></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">Diameter</label></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">Color</label></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">Warranty</label></center>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="font-size: 14px !important;">L- Series (Indoor)</td>
                                                                                            <td style="font-size: 14px !important;">60" - Universal - Black/ White</td>
                                                                                            <td style="font-size: 14px !important;">
                                                                                                pink
                                                                                            </td>
                                                                                            <td style="font-size: 14px !important;" rowspan="3">
                                                                                                1 month
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr style="background-color: #8c8c8c;">
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">Power</label></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">Extension</label></center>
                                                                                            </td>
                                                                                            <td>
                                                                                                <center style="font-size: 14px !important;color: white !important;"><label style="font-size: 14px !important;">LED</label></center>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="font-size: 14px !important;">
                                                                                                N/A
                                                                                            </td>
                                                                                            <td style="font-size: 14px !important;">
                                                                                                N/A
                                                                                            </td>
                                                                                            <td style="font-size: 14px !important;">
                                                                                                N/A
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                            <td style="vertical-align: middle;font-size: 14px !important;">
                                                                                <center>
                                                                                    PHP &nbsp; 60,000.00
                                                                                </center>
                                                                            </td>
                                                                            <td style="vertical-align: middle;font-size: 14px !important;">
                                                                                <center>
                                                                                    1
                                                                                </center>
                                                                            </td>
                                                                            <td style="vertical-align: middle;font-size: 14px !important;">
                                                                                <center>
                                                                                    PHP &nbsp;60,000.00
                                                                                </center>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="head" style="background-color: black  !important;">
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;">NOTE:</th>
                                                                            <th class="text-center" style="color: white;" colspan="6"></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="7" style="font-size: 14px !important;">
                                                                                - Installation doesn't include any health testing required by client. Additional costs shouldered by Client related to testing and all additional PPEs.<br>
                                                                                - Please see attached warranty.<br>
                                                                                - Quotations are valid for 30 days from the date of the quotation.<br>
                                                                            </td>
                                                                        </tr>
                                                                        <tr></tr>
                                                                        <tr class="head" style="background-color: black  !important;">
                                                                            <th class="text-center" style="color: white;font-size: 14px !important;">ADDITIONAL NOTE:</th>
                                                                            <th class="text-center" style="color: white;" colspan="6"></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="7" style="font-size: 14px !important;">
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <table style="width: 100%;">
                                                                    <tbody>
                                                                        <tr style="background-color: black;">
                                                                            <th class="text-center" style="padding:10px;color:white;font-size: 14px !important;" colspan="4">SUMMARY</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 50%; vertical-align:top">
                                                                                <table style="width: 100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding: 10px;font-size: 14px !important;" class="custom-tbl">
                                                                                                Payment Method:
                                                                                            </td>
                                                                                            <td style="padding:10px;vertical-align: middle;font-size: 14px !important;">
                                                                                                Cash
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="padding: 10px;font-size: 14px !important;" class="custom-tbl">
                                                                                                Product Cost:
                                                                                            </td>
                                                                                            <td style="padding:10px;font-size: 14px !important;">
                                                                                                PHP &nbsp;110,000.00
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="padding: 10px;font-size: 14px !important;" class="custom-tbl">
                                                                                                Delivery Fee:
                                                                                            </td>
                                                                                            <td style="padding:10px;font-size: 14px !important;">
                                                                                                PHP &nbsp;500.00
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                            <td style="width: 50%; vertical-align:top">
                                                                                <table style="width: 100%">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding: 10px;font-size: 14px !important;" class="custom-tbl">
                                                                                                Labor Cost
                                                                                            </td>
                                                                                            <td style="padding:10px;font-size: 14px !important;">
                                                                                                PHP &nbsp;100.00
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="padding: 10px;font-size: 14px !important;" class="custom-tbl">
                                                                                                Material Cost:
                                                                                            </td>
                                                                                            <td style="padding:10px;font-size: 14px !important;">
                                                                                                PHP &nbsp;200.00
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="padding: 10px;font-size: 14px !important;" class="custom-tbl">
                                                                                                Mobilization:
                                                                                            </td>
                                                                                            <td style="padding:10px;font-size: 14px !important;">
                                                                                                PHP &nbsp;300.00
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style="padding: 10px;font-size: 14px !important;" class="custom-tbl">
                                                                                                Others (Installation fee)
                                                                                            </td>
                                                                                            <td style="padding:10px;font-size: 14px !important;">
                                                                                                PHP &nbsp;400.00
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="background-color: black;" class="custom-tbl" colspan="3"><label style="padding:10px 10px 10px 0;color:white;font-size: 14px !important;">&nbsp;&nbsp;&nbsp;Other Fees:</label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding:10px;" hidden="">
                                                                                <input id="misc_item${a}" class="others form-control input-sm text-right" style="width:100%;" value="${a}" type="text" name="misc_item[]">
                                                                            </td>
                                                                            <td style="padding:10px;font-size: 14px !important;">
                                                                                Descr 1
                                                                            </td>
                                                                            <td style="padding:10px;font-size: 14px !important;">
                                                                                PHP &nbsp;150.00
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding:10px;" hidden="">
                                                                                <input id="misc_item${a}" class="others form-control input-sm text-right" style="width:100%;" value="${a}" type="text" name="misc_item[]">
                                                                            </td>
                                                                            <td style="padding:10px;font-size: 14px !important;">
                                                                                Descr 2
                                                                            </td>
                                                                            <td style="padding:10px;font-size: 14px !important;">
                                                                                PHP &nbsp;250.00
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="background-color: black;" class="custom-tbl" colspan="3"><label style="padding:10px 10px 10px 0;color:white;font-size: 14px !important;">&nbsp;&nbsp;&nbsp;</label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 10px;font-size: 14px !important;" class="custom-tbl">
                                                                                Subtotal:
                                                                            </td>
                                                                            <td style="padding:10px;font-size: 14px !important;">
                                                                                PHP &nbsp;111,900.00
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 10px;font-size: 14px !important;" class="custom-tbl">
                                                                                Discount:
                                                                            </td>
                                                                            <td style="padding:10px;vertical-align: middle;font-size: 14px !important;">
                                                                                PHP 1,000.00
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 10px;font-size: 14px !important;" class="custom-tbl">
                                                                                VAT(12%):
                                                                            </td>
                                                                            <td style="padding:10px;vertical-align: middle;font-size: 14px !important;">
                                                                                PHP 13,308.00
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 10px;font-size: 14px !important;" class="custom-tbl">
                                                                                Total Amount(+ VAT):
                                                                            </td>
                                                                            <td style="padding:10px;vertical-align: middle;font-size: 14px !important;">
                                                                                PHP 124,208.00
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="background-color: black;" class="custom-tbl" colspan="3"><label style="padding:10px 10px 10px 0;color:white;font-size: 14px !important;">&nbsp;&nbsp;&nbsp;</label></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 10px;font-size: 14px !important;" class="custom-tbl">
                                                                                Grand Total:
                                                                            </td>
                                                                            <td style="padding:10px;vertical-align: middle;font-size: 14px !important;">
                                                                                PHP 124,208.00
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <table style="width: 100%;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="custom-tbl" colspan="2" rowspan="3" style="padding:20px;font-size: 14px !important;">
                                                                                <b>Quotation prepared by:</b>&nbsp;&nbsp; <u>Aeron(sales Dummy)</u>
                                                                                <br>
                                                                                <br>
                                                                                This is a quotation on the goods, named, subject to the conditions noted below:<br>
                                                                                (Describe any conditions pertaining to these prices and any additional terms of the agreement.<br>
                                                                                You may want to include contingencies that will affect the quotation.)
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                To accept this quotation, sign here and return: ______________________________________
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br><br>
                        <div>
                            <center>
                                <button class="button btn-success this_print" style="background: #449d44 !important;border: none;padding: 10px;border-radius: 5px;">
                                <i class="fa fa-print"></i>
                                &nbsp;&nbsp;Print Report
                                </button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $('.this_print').click(function(){
                window.print();
            });
            $('.full-div').fadeOut();
        </script>
    </body>
</html>