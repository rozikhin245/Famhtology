<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Undangan</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display&display=swap');

        body {
            font-family: 'Playfair Display', serif;
            background: url('/storage/background/undangan.jpg') no-repeat center center;
            background-size: cover;
            padding: 50px;
            width: 800px;
            height: 1130px;
            margin: auto;
            color: #000;
        }

        .judul {
            text-align: center;
            font-family: 'Great Vibes', cursive;
            color: #d17b7b;
            font-size: 28px;
        }

        .isi {
            margin-top: 30px;
            font-size: 18px;
            line-height: 1.8;
        }

        .bold {
            font-weight: bold;
        }

        .note {
            margin-top: 30px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="judul">
        <h2>Undangan</h2>
        <p>Keluarga Besar Abd Azis</p>
    </div>

    <div class="isi">
        <p>Assalamualaikum Wr. Wb</p>
        <p>Dalam rangka {{ $activity->name }}, kami mohon kehadiran seluruh keluarga besar pada:</p>

        <p><span class="bold">Hari/Tanggal</span>: {{ \Carbon\Carbon::parse($activity->date)->translatedFormat('l, d F Y') }}</p>
        <p><span class="bold">Tempat</span>: {{ $activity->location }}</p>
        <p><span class="bold">Waktu</span>: {{ $activity->start_time }} - {{ $activity->end_time ?? 'Selesai' }}</p>

        <p>Demikian undangan disampaikan, atas perhatiannya kami ucapkan terimakasih.</p>

        <p><strong>Wassalamualaikum Wr. Wb</strong></p>

        @if(!empty($activity->notes))
            <div class="note">
                <p><strong>Note:</strong></p>
                <ul>
                    @foreach (json_decode($activity->notes) as $note)
                        <li>{{ $note }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>
