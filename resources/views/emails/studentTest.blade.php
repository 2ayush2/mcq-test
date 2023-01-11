<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <title>MCQ Test for {{$data["name"]}}</title>
</head>

<body style="margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0; width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;background-color:'#f0f0f0'">

    <div style="margin: 5px;">
        <div style="width: 100%;*zoom: 1;">
            <div style="padding: 5px;">
                <p style="text-align:justify;">Dear {{$data["name"]}},</p>
                <p style="text-align:justify;">
                    Your test paper is ready. Please follow following link to start your paper.<br />
                    <a href="{{ route('student.test',['testid'=>$data['code']]) }}">{{ route('student.test',['testid'=>$data['code']]) }}</a>.
                </p>
                <p style="text-align:justify;">
                    <strong>Note:</strong>
                <ul>
                    <li>Once you have opened the link you must complete the test.</li>
                    <li>Link would not be valid once opened</li>
                    <li>You must attempt all the multiple choice questions</li>
                    <li>Do not try to cheat</li>
                </ul>
                </p>
                <p style="text-align:justify;">
                    <strong>Best of Luck</strong><br />
                    Thank you<br />
                    MQC Inverview Assignment<br />
                    By Shree Krishna Acharya<br />
                    {{config("app.name")}}
                </p>
            </div>
        </div>
</body>

</html>