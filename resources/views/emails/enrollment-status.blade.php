<!DOCTYPE html>
<html>
<body style="margin:0; padding:0; background-color:#f3f4f6; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f3f4f6; padding:40px 0;">
        <tr>
            <td align="center">
                <table width="100%" style="max-width:520px; background:#ffffff; border-radius:16px; overflow:hidden;">

                    <tr>
                        <td style="background-color:#0a1033; padding:28px 32px;">
                            <span style="color:#ffffff; font-size:20px; font-weight:900;">KANTSA <span style="color:#dc2626;">International</span></span>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:32px;">
                            <p style="font-size:15px; color:#0f172a; margin:0 0 16px;">Bonjour {{ $enrollment->user->name }},</p>

                            @if($enrollment->status === 'confirmed')
                                <p style="font-size:15px; color:#0f172a; line-height:1.6; margin:0 0 16px;">
                                    🎉 Ton inscription au cours <strong>{{ $enrollment->courseSession->title }}</strong> est <strong style="color:#059669;">confirmée</strong> !
                                </p>
                                <p style="font-size:14px; color:#475569; line-height:1.6;">
                                    Rentrée prévue : <strong>{{ $enrollment->courseSession->start_date ?? 'à venir' }}</strong> — {{ $enrollment->courseSession->location }}.
                                    Notre équipe te contactera pour finaliser les modalités.
                                </p>
                            @elseif($enrollment->status === 'cancelled')
                                <p style="font-size:15px; color:#0f172a; line-height:1.6; margin:0 0 16px;">
                                    Ton inscription au cours <strong>{{ $enrollment->courseSession->title }}</strong> a été annulée.
                                </p>
                                <p style="font-size:14px; color:#475569; line-height:1.6;">Si tu penses qu'il s'agit d'une erreur, contacte-nous directement.</p>
                            @else
                                <p style="font-size:15px; color:#0f172a; line-height:1.6; margin:0 0 16px;">
                                    Le statut de ton inscription au cours <strong>{{ $enrollment->courseSession->title }}</strong> a été mis à jour : <strong>{{ $enrollment->status }}</strong>.
                                </p>
                            @endif

                            <div style="text-align:center; margin-top:28px;">
                                <a href="{{ route('language-courses.show', $enrollment->courseSession->id) }}" style="display:inline-block; background-color:#dc2626; color:#ffffff; text-decoration:none; padding:12px 28px; border-radius:10px; font-weight:bold; font-size:13px;">
                                    Voir le cours
                                </a>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color:#f8fafc; padding:20px 32px; text-align:center;">
                            <p style="font-size:11px; color:#94a3b8; margin:0;">KANTSA International Institute — Douala & Yaoundé, Cameroun</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
