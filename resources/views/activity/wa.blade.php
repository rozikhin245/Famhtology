@php
    $waText = urlencode(
        "
*----------- undangan -------------*
*----keluarga besar abd aziz-------*

_Assalamualaikum Wr Wb_

Dalam rangka *{$activity->name}*, kami mohon kehadiran seluruh keluarga besar pada :

📅 *Hari/Tanggal* : " .
            \Carbon\Carbon::parse($activity->date)->translatedFormat('l, d F Y') .
            "
📍 *Tempat* : {$activity->location}
⏰ *Waktu* : {$activity->start_time} - {$activity->end_time}

Demikian undangan disampaikan, atas perhatiannya kami ucapkan terima kasih.

_Wassalamualaikum Wr.Wb_

*Noted:*
- " .
            implode("\n- ", json_decode($activity->notes ?? '[]')),
    );

@endphp
<a href="https://wa.me/?text={{ $waText }}" target="_blank"
class="inline-block mt-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm">
Share via WhatsApp
</a>
