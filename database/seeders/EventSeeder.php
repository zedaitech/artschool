<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $address = "Shree Narayana Guru School of Art\n1-284/1/4, Shree Mahaguru Krupa,\nAdkabail Road, Adka, Kotekar,\nVTC: Mangaluru, PO: Kotekar,\nDistrict: Dakshina Kannada – 575022\nKarnataka, India";

        $bodyEn = <<<'HTML'
<p>On the occasion of the birth anniversary of <strong>Bhagavan Shree Narayana Guru</strong>, Shree Narayana Guru School of Art, Mangaluru — a Government of India MSME (Udyam) registered art education institution — presents <strong>Shree Guru Varna Vaibhava&nbsp;–&nbsp;2026</strong>, a state level drawing competition for school students.</p>
<p>Held in association with <strong>Dr. Shree S. Ramappaji</strong>, Hereditary Dharmadarshi, Founder &amp; President, Sri Sigandoor Chowdamma Devi Trust®.</p>

<h3>Categories &amp; Themes</h3>
<table>
    <thead>
        <tr><th>Category</th><th>Classes</th><th>Theme</th><th>Medium</th></tr>
    </thead>
    <tbody>
        <tr><td>Category&nbsp;I</td><td>Classes 1 to 4</td><td>My Nature</td><td>Any colour medium</td></tr>
        <tr><td>Category&nbsp;II</td><td>Classes 5 to 7</td><td>Portrait of Bhagavan Shree Narayana Guru</td><td>Any colour medium</td></tr>
        <tr><td>Category&nbsp;III</td><td>Classes 8 to 10</td><td>Shree Narayana Guru – Kshetra Prathishta</td><td>Water colour only</td></tr>
    </tbody>
</table>

<h3>Prizes</h3>
<p>In <em>each</em> category: <strong>First Prize</strong>, <strong>Second Prize</strong> and <strong>Third Prize</strong> cash awards, plus <strong>consolation prizes</strong>. Cash prizes and certificates will be awarded to the winners.</p>

<h3>How to Enter</h3>
<ul>
    <li><strong>No entry fee — participation is absolutely free.</strong></li>
    <li>Send your artwork by post to the address given alongside, on or before the last date.</li>
    <li>Last date for submission: <strong>28 August 2026</strong>.</li>
    <li>For any queries call <strong>9483024279</strong> (after 3:00 PM).</li>
</ul>

<p><em>Encourage Creativity… Celebrate Talent… Inspire the Future!</em></p>
HTML;

        $bodyKn = <<<'HTML'
<p><strong>ಭಗವಾನ್ ಶ್ರೀ ನಾರಾಯಣ ಗುರುಗಳ</strong> ಜನ್ಮ ದಿನಾಚರಣೆಯ ಸಂದರ್ಭದಲ್ಲಿ, ಶ್ರೀ ನಾರಾಯಣ ಗುರು ಸ್ಕೂಲ್ ಆಫ್ ಆರ್ಟ್, ಮಂಗಳೂರು — ಭಾರತ ಸರ್ಕಾರದ MSME (ಉದ್ಯಮ) ನೋಂದಾಯಿತ ಕಲಾ ಶಿಕ್ಷಣ ಸಂಸ್ಥೆ — ಶಾಲಾ ವಿದ್ಯಾರ್ಥಿಗಳಿಗಾಗಿ <strong>ಶ್ರೀ ಗುರು ವರ್ಣ ವೈಭವ&nbsp;–&nbsp;೨೦೨೬</strong> ರಾಜ್ಯ ಮಟ್ಟದ ಚಿತ್ರಕಲಾ ಸ್ಪರ್ಧೆಯನ್ನು ಆಯೋಜಿಸಿದೆ.</p>
<p>ಸಹಯೋಗ: <strong>ಡಾ. ಶ್ರೀ ಎಸ್. ರಾಮಪ್ಪಜಿ</strong>, ಆನುವಂಶಿಕ ಧರ್ಮದರ್ಶಿ, ಸಂಸ್ಥಾಪಕರು ಮತ್ತು ಅಧ್ಯಕ್ಷರು, ಶ್ರೀ ಸಿಗಂದೂರು ಚೌಡಮ್ಮ ದೇವಿ ಟ್ರಸ್ಟ್®.</p>

<h3>ವಿಭಾಗಗಳು ಮತ್ತು ವಿಷಯಗಳು</h3>
<table>
    <thead>
        <tr><th>ವಿಭಾಗ</th><th>ತರಗತಿ</th><th>ವಿಷಯ</th><th>ಮಾಧ್ಯಮ</th></tr>
    </thead>
    <tbody>
        <tr><td>ವಿಭಾಗ&nbsp;೧</td><td>೧ ರಿಂದ ೪</td><td>ನನ್ನ ಪ್ರಕೃತಿ</td><td>ಯಾವುದೇ ಬಣ್ಣದ ಮಾಧ್ಯಮ</td></tr>
        <tr><td>ವಿಭಾಗ&nbsp;೨</td><td>೫ ರಿಂದ ೭</td><td>ಭಗವಾನ್ ಶ್ರೀ ನಾರಾಯಣ ಗುರುಗಳ ಭಾವಚಿತ್ರ</td><td>ಯಾವುದೇ ಬಣ್ಣದ ಮಾಧ್ಯಮ</td></tr>
        <tr><td>ವಿಭಾಗ&nbsp;೩</td><td>೮ ರಿಂದ ೧೦</td><td>ಶ್ರೀ ನಾರಾಯಣ ಗುರು – ಕ್ಷೇತ್ರ ಪ್ರತಿಷ್ಠೆ</td><td>ಜಲವರ್ಣ ಮಾತ್ರ</td></tr>
    </tbody>
</table>

<h3>ಬಹುಮಾನಗಳು</h3>
<p><em>ಪ್ರತಿ</em> ವಿಭಾಗದಲ್ಲಿ <strong>ಪ್ರಥಮ</strong>, <strong>ದ್ವಿತೀಯ</strong> ಮತ್ತು <strong>ತೃತೀಯ</strong> ನಗದು ಬಹುಮಾನಗಳು, ಜೊತೆಗೆ <strong>ಸಮಾಧಾನಕರ ಬಹುಮಾನಗಳು</strong>. ವಿಜೇತರಿಗೆ ನಗದು ಬಹುಮಾನ ಮತ್ತು ಪ್ರಮಾಣಪತ್ರಗಳನ್ನು ನೀಡಲಾಗುವುದು.</p>

<h3>ಭಾಗವಹಿಸುವುದು ಹೇಗೆ</h3>
<ul>
    <li><strong>ಪ್ರವೇಶ ಶುಲ್ಕವಿಲ್ಲ — ಭಾಗವಹಿಸುವಿಕೆ ಸಂಪೂರ್ಣ ಉಚಿತ.</strong></li>
    <li>ಕೊನೆಯ ದಿನಾಂಕದ ಒಳಗೆ ನಿಮ್ಮ ಕಲಾಕೃತಿಯನ್ನು ಪಕ್ಕದಲ್ಲಿ ನೀಡಿರುವ ವಿಳಾಸಕ್ಕೆ ಅಂಚೆ ಮೂಲಕ ಕಳುಹಿಸಿ.</li>
    <li>ಸಲ್ಲಿಕೆಗೆ ಕೊನೆಯ ದಿನಾಂಕ: <strong>೨೮ ಆಗಸ್ಟ್ ೨೦೨೬</strong>.</li>
    <li>ಯಾವುದೇ ಪ್ರಶ್ನೆಗಳಿಗೆ <strong>9483024279</strong> ಗೆ ಕರೆ ಮಾಡಿ (ಮಧ್ಯಾಹ್ನ ೩:೦೦ ರ ನಂತರ).</li>
</ul>

<p><em>ಸೃಜನಶೀಲತೆಯನ್ನು ಪ್ರೋತ್ಸಾಹಿಸಿ… ಪ್ರತಿಭೆಯನ್ನು ಆಚರಿಸಿ… ಭವಿಷ್ಯಕ್ಕೆ ಸ್ಫೂರ್ತಿ ನೀಡಿ!</em></p>
HTML;

        $events = [
            [
                'slug' => 'shree-guru-varna-vaibhava-2026',
                'title' => [
                    'en' => 'Shree Guru Varna Vaibhava – 2026',
                    'kn' => 'ಶ್ರೀ ಗುರು ವರ್ಣ ವೈಭವ – ೨೦೨೬',
                ],
                'excerpt' => [
                    'en' => 'A state level drawing competition for school students, held on the occasion of the birth anniversary of Bhagavan Shree Narayana Guru. Three categories, cash prizes and certificates — and no entry fee.',
                    'kn' => 'ಭಗವಾನ್ ಶ್ರೀ ನಾರಾಯಣ ಗುರುಗಳ ಜನ್ಮ ದಿನಾಚರಣೆಯ ಸಂದರ್ಭದಲ್ಲಿ ಶಾಲಾ ವಿದ್ಯಾರ್ಥಿಗಳಿಗಾಗಿ ರಾಜ್ಯ ಮಟ್ಟದ ಚಿತ್ರಕಲಾ ಸ್ಪರ್ಧೆ. ಮೂರು ವಿಭಾಗಗಳು, ನಗದು ಬಹುಮಾನ ಮತ್ತು ಪ್ರಮಾಣಪತ್ರಗಳು — ಪ್ರವೇಶ ಶುಲ್ಕವಿಲ್ಲ.',
                ],
                'body' => ['en' => $bodyEn, 'kn' => $bodyKn],
                'location' => ['en' => $address, 'kn' => $address],
                // The competition's operative date is the submission deadline.
                'starts_at' => '2026-08-28 00:00:00',
                'ends_at' => null,
                'image' => '/images/events/varna-vaibhava-2026-poster.jpg',
                'is_featured' => true,
                'is_published' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::query()->updateOrCreate(['slug' => $event['slug']], $event);
        }
    }
}
