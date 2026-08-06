<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;

/*
| An open call for taluk and district coordinators across Karnataka. It has
| no closing date — applications stay open — so starts_at is left null,
| which keeps it listed as current and suppresses the date line.
*/

return new class extends Migration
{
    private const SLUG = 'coordinators-wanted-karnataka';

    public function up(): void
    {
        Event::query()->updateOrCreate(
            ['slug' => self::SLUG],
            [
                'kind' => 'announcement',
                'title' => [
                    'en' => 'Coordinators Wanted Across Karnataka',
                    'kn' => 'ಕರ್ನಾಟಕದಾದ್ಯಂತ ಕೋ-ಆರ್ಡಿನೇಟರ್‌ಗಳು ಬೇಕಾಗಿದ್ದಾರೆ',
                ],
                'excerpt' => [
                    'en' => 'We are inviting enthusiastic district and taluk coordinators to organise drawing competitions, art training, exhibitions and creative activities for school students across every taluk and district of Karnataka.',
                    'kn' => 'ಕರ್ನಾಟಕದ ಪ್ರತಿಯೊಂದು ತಾಲೂಕು ಹಾಗೂ ಜಿಲ್ಲಾ ಕೇಂದ್ರಗಳಲ್ಲಿ ಶಾಲಾ ವಿದ್ಯಾರ್ಥಿಗಳಿಗಾಗಿ ಚಿತ್ರಕಲಾ ಸ್ಪರ್ಧೆಗಳು, ತರಬೇತಿ ಕಾರ್ಯಕ್ರಮಗಳು ಮತ್ತು ಕಲಾ ಪ್ರದರ್ಶನಗಳನ್ನು ಸಂಘಟಿಸಲು ಉತ್ಸಾಹಿ ಕೋ-ಆರ್ಡಿನೇಟರ್‌ಗಳನ್ನು ಆಹ್ವಾನಿಸಲಾಗುತ್ತಿದೆ.',
                ],
                'body' => [
                    'en' => $this->bodyEn(),
                    'kn' => $this->bodyKn(),
                ],
                'location' => [
                    'en' => 'Every taluk and district across Karnataka',
                    'kn' => 'ಕರ್ನಾಟಕದ ಪ್ರತಿಯೊಂದು ತಾಲೂಕು ಮತ್ತು ಜಿಲ್ಲೆ',
                ],
                // An open call: no closing date, so none is shown.
                'starts_at' => null,
                'ends_at' => null,
                'image' => '/images/events/coordinators-wanted-karnataka.jpg',
                'is_featured' => false,
                'is_published' => true,
            ],
        );
    }

    public function down(): void
    {
        Event::query()->where('slug', self::SLUG)->delete();
    }

    private function bodyKn(): string
    {
        return <<<'HTML'
<p><strong>ಶ್ರೀ ನಾರಾಯಣ ಗುರು ಸ್ಕೂಲ್ ಆಫ್ ಆರ್ಟ್, ಮಂಗಳೂರು</strong> ವತಿಯಿಂದ ಕರ್ನಾಟಕದ ಪ್ರತಿಯೊಂದು ತಾಲೂಕು ಹಾಗೂ ಜಿಲ್ಲಾ ಕೇಂದ್ರಗಳಲ್ಲಿ ಶಾಲಾ ವಿದ್ಯಾರ್ಥಿಗಳಿಗಾಗಿ ಚಿತ್ರಕಲಾ ಸ್ಪರ್ಧೆಗಳು, ಚಿತ್ರಕಲಾ ತರಬೇತಿ ಕಾರ್ಯಕ್ರಮಗಳು, ಕಲಾ ಪ್ರದರ್ಶನಗಳು ಮತ್ತು ಸೃಜನಾತ್ಮಕ ಚಟುವಟಿಕೆಗಳನ್ನು ಸಂಘಟಿಸಲು ಉತ್ಸಾಹಿ District &amp; Taluk Coordinatorsರನ್ನು ಆಹ್ವಾನಿಸಲಾಗುತ್ತಿದೆ.</p>

<h3>ಜವಾಬ್ದಾರಿಗಳು</h3>
<ul>
<li>ಶಾಲೆಗಳೊಂದಿಗೆ ಸಮನ್ವಯ ಸಾಧಿಸುವುದು.</li>
<li>ತಾಲೂಕು ಮತ್ತು ಜಿಲ್ಲಾ ಮಟ್ಟದ ಚಿತ್ರಕಲಾ ಸ್ಪರ್ಧೆಗಳನ್ನು ಆಯೋಜಿಸುವುದು.</li>
<li>ವಿದ್ಯಾರ್ಥಿಗಳ ನೋಂದಣಿ ಮತ್ತು ಮಾರ್ಗದರ್ಶನ.</li>
<li>ಸ್ಥಳೀಯ ಕಾರ್ಯಕ್ರಮಗಳ ಸಮನ್ವಯ.</li>
<li>ಸಂಸ್ಥೆಯ ಕಲಾ ಚಟುವಟಿಕೆಗಳನ್ನು ವಿಸ್ತರಿಸುವುದು.</li>
</ul>

<h3>ಅರ್ಹತೆ</h3>
<ul>
<li>ಕಲೆ ಮತ್ತು ಶಿಕ್ಷಣ ಕ್ಷೇತ್ರದಲ್ಲಿ ಆಸಕ್ತಿ.</li>
<li>ಉತ್ತಮ ಸಂಘಟನಾ ಹಾಗೂ ಸಂವಹನ ಕೌಶಲ್ಯ.</li>
<li>ಸಮಾಜ ಸೇವಾ ಮನೋಭಾವ.</li>
<li>ಶಾಲೆಗಳು ಹಾಗೂ ಶಿಕ್ಷಣ ಸಂಸ್ಥೆಗಳೊಂದಿಗೆ ಸಂಪರ್ಕ ಹೊಂದಿದ್ದರೆ ಹೆಚ್ಚುವರಿ ಅನುಕೂಲ.</li>
</ul>

<h3>ನಾವು ನೀಡುವುದು</h3>
<ul>
<li>ಅಧಿಕೃತ Coordinator Appointment Letter</li>
<li>Identity Card</li>
<li>ತರಬೇತಿ ಮತ್ತು ಮಾರ್ಗದರ್ಶನ</li>
<li>ಕಾರ್ಯಕ್ರಮಗಳನ್ನು ನಡೆಸಲು ಸಂಸ್ಥೆಯ ಸಹಕಾರ</li>
<li>ಉತ್ತಮ ಕಾರ್ಯನಿರ್ವಹಣೆಗೆ ಪ್ರಶಂಸಾ ಪ್ರಮಾಣಪತ್ರ ಮತ್ತು ಗೌರವ</li>
</ul>

<p>ಆಸಕ್ತರು ತಮ್ಮ ಸಂಪೂರ್ಣ ವಿವರಗಳನ್ನು ಕಳುಹಿಸಬಹುದು.</p>

<p>ಮೊಬೈಲ್: 9483024279<br>
Website: www.shreenarayanaguruschoolofart.in</p>

<p><strong>ಸುರೇಶ್ ಕೆ. ಪಾಂಡವರಕಲ್ಲು</strong><br>
ಸಂಸ್ಥಾಪಕರು ಮತ್ತು ನಿರ್ದೇಶಕರು<br>
ಶ್ರೀ ನಾರಾಯಣ ಗುರು ಸ್ಕೂಲ್ ಆಫ್ ಆರ್ಟ್, ಮಂಗಳೂರು</p>
HTML;
    }

    private function bodyEn(): string
    {
        return <<<'HTML'
<p><strong>Shree Narayana Guru School of Art, Mangaluru</strong> — a Government of India MSME (Udyam) registered art education institution — invites enthusiastic District &amp; Taluk Coordinators to organise drawing competitions, art training programmes, exhibitions and creative activities for school students in every taluk and district centre across Karnataka.</p>

<h3>Roles &amp; responsibilities</h3>
<ul>
<li>Co-ordinate with schools.</li>
<li>Organise drawing competitions at taluk and district level.</li>
<li>Register and guide participating students.</li>
<li>Co-ordinate local programmes.</li>
<li>Extend the institution's art activities in your region.</li>
</ul>

<h3>Eligibility</h3>
<ul>
<li>An interest in art and education.</li>
<li>Good organisational and communication skills.</li>
<li>A spirit of community service.</li>
<li>Existing contact with schools and educational institutions is an added advantage.</li>
</ul>

<h3>What we offer</h3>
<ul>
<li>An official Coordinator Appointment Letter</li>
<li>Identity card</li>
<li>Training and continuous guidance</li>
<li>Institutional support for running programmes</li>
<li>A certificate of appreciation and recognition for outstanding work</li>
</ul>

<p>Interested candidates may send their full details.</p>

<p>Mobile: 9483024279<br>
Website: www.shreenarayanaguruschoolofart.in</p>

<p><strong>Suresh K. Pandavarakallu</strong><br>
Founder &amp; Director<br>
Shree Narayana Guru School of Art, Mangaluru</p>
HTML;
    }
};
