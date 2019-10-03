<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt Viewer</title>
    <style>
        *{
            font-family: Arial;
        }

        @media print{
            .printBt, .backBt{
                display: none;
            }
            a{
                text-decoration: none;
                color: black;
            }
        }

        img{
            margin-bottom: 20px;
            margin-top: 20px;
        }
        .printBt, .backBt{
            border: 0;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            position: fixed;
            padding: 10px 20px;
            font-size: 25px;
        }

        .printBt{
            bottom: 20px;
            right: 20px;
            background-color: #1A00FF;
        }

        .printBt:hover{
            background-color: #0F0097;
        }

        .backBt{
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #01FF00;
        }

        .backBt:hover{
            background-color: #009700;
        }
    </style>
</head>
<body>
    <div class="r-container" style="text-align:center;">
        <h1>Receipt of order <a href="<?=base_url()?>AdminOrder/details/<?=$order['order_id']?>"><?=$order['order_id']?></a></h1>
        <h3>Order Date : <?= date('d F Y', $order['order_date']) ?></h3>
        <center>
            <a href="<?=base_url()?>assets/img/receipt/<?=$order['transfer_proof_img']?>"><img height="600" src="<?=base_url()?>assets/img/receipt/<?=$order['transfer_proof_img']?>" alt="Failed to get image"></a>
            <h3>Receiver phone number : <?=$order['phone_number']?></h3>
        </center>
        <button class="backBt" onclick="history.go(-1)">Back</button>
        <button class="printBt" onclick="window.print()">Print Receipt</button>
    </div>
</body>
</html>