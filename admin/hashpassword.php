<?php
echo password_hash('okashapassword', PASSWORD_DEFAULT);
?>

$mail->Body = "
            <html>
            <body>
                <h2>Interview Notice - Skill Builder Academy</h2>
                <p>Dear {$recipient['name']},</p>
                <p>Thank you for your application to the Skill Builder Academy internship program. Please find attached your interview notice with important details about your upcoming interview.</p>
                <p>Please review the attached document carefully and ensure you follow all the instructions provided.</p>
                <p>If you have any questions, please don't hesitate to contact us.</p>
                <br>
                <p>Best regards,<br>Skill Builder Academy Team</p>
            </body>
            </html>";
            
            $mail->AltBody = "Dear {$recipient['name']},\n\n".
                            "Thank you for your application to the Skill Builder Academy internship program. Please find attached your interview notice with important details about your upcoming interview.\n\n".
                            "Please review the attached document carefully and ensure you follow all the instructions provided.\n\n".
                            "If you have any questions, please don't hesitate to contact us.\n\n".
                            "Best regards,\nSkill Builder Academy Team";