<!DOCTYPE html>
<html>
<head>
    <title>Event reservation</title>
    <style>
        * {
            font-family: montserrat;
        }
        .body {
            padding: 15px;
        }
        .ticket {
            background-color: #e1e1d6;
            border-radius: 7px;
            margin: 15px;
        }
        .ticket-header {
            display: flex;
            justify-content: center;
            gap: 100%;
            align-items: center;
            padding-inline: 15px;
        }
        .header {
            background-color: #000000;
            padding: 20px;
            text-align: center;
            color: #fff;
            display: flex;
            align-items: flex-end;
            gap: 15px;
            justify-content: center;
        }
        .header-info {
            display: flex;
            justify-content: center;
            gap: 100%;
            padding-inline: 15px;
            gap: 15px;
            align-items: flex-start;
            border-top: solid #000 2px;
            border-bottom: solid #000 1.5px;
        } 
        .ticket-footer {
            display: flex;
            justify-content: center;
            gap: 100%;
            padding-inline: 15px;
            align-items: center;
            border-top: solid #000 1.5px;
        }
        .verification-code {
            background-color: #00000075;
            height: 28px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #e1e1d6;
            padding: 2px;
        }
        .note {
            background-color: #f00;
            color: #fff;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div style="background-color: #f1f1f1; padding: 20px;">
        <div style="max-width: 600px; margin: 0 auto; background-color: #fff;">
            <div style="background-color: #000000; padding: 20px; text-align: center; color: #fff;">
                <h1 style="font-weight: 900; margin: 0;">Evento Tickets</h1>
            </div>
            <div style="padding: 20px;">
                <h2 style="margin-top: 0;">You have reserved a ticket at {{ session('event_name') }}</h2>
                <p>And for that you have received your ticket to the event:</p>
            </div>
            <div class="ticket" style="background-color: #e1e1d6; border-radius: 7px; margin: 15px;">
                <div class="ticket-header" style="display: flex; justify-content: center; align-items: center; padding: 15px;gap:100px">
                    <h1>EVENTO</h1>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <h1>Event ticket</h1>
                </div>
                <div class="ticket-body" style="padding: 20px;">
                    <div class="header-info" style="display: flex; justify-content: center; align-items: flex-start; border-top: solid #000 2px; border-bottom: solid #000 1.5px; padding-inline: 15px;gap:20px">
                        <div class="col" style="flex: 1;">
                            <h2>{{ session('event_name') }}</h2>
                            <h4>{{ session('event_location') }}</h4>
                            <p>{{ session('event_date') }} {{ session('event_time') }}</p>
                        </div>
                        <div class="col-2" style="flex: 1;">
                            <h2>{{ session('event_price') }} $</h2>
                        </div>
                    </div>
                </div>
                <div class="ticket-footer" style="display: flex; justify-content: center; align-items: center; border-top: solid #000 1.5px; padding-inline: 15px;">
                    <h4 style="margin: 0;">Verification code:</h4>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="verification-code" style="background-color: #00000075; height: 28px; display: flex; justify-content: center; align-items: center; color: #e1e1d6; padding: 2px;">
                        <h3 style="margin: 0;"># {{ session('event_token') }}</h3>
                    </div>
                </div>
            </div>
            <div style="padding: 20px;">
                <p class="note" style="background-color: #f00; color: #fff; padding: 15px;">Do not share nor this ticket nor the verification code with anyone, it is unique to you.</p>
                <p>Thank you for using our services, we hope you enjoy the event.</p>
                <h2>EVENTO.</h2>
            </div>
        </div>
    </div>
</body>
</html>