<?php

use App\Models\Event;
use Illuminate\Database\Migrations\Migration;

/*
| The website launch at Sigandur, announced with footage of the occasion.
| Events are database rows with no Filament resource yet, so a migration is
| how content reaches a running site — the same route the seeder data took.
*/

return new class extends Migration
{
    private const SLUG = 'official-website-launch';

    public function up(): void
    {
        Event::query()->updateOrCreate(
            ['slug' => self::SLUG],
            [
                'kind' => 'announcement',
                'title' => [
                    'en' => 'Official Website Launch',
                    'kn' => 'ಅಧಿಕೃತ ವೆಬ್‌ಸೈಟ್ ಲೋಕಾರ್ಪಣೆ',
                ],
                'excerpt' => [
                    'en' => 'The school’s official website was launched at the sacred Sigandur kshetra by Dr. Sri S. Ramappaji, founder and president of the Sri Sigandur Chowdamma Devi Trust®.',
                    'kn' => 'ಶ್ರೀ ಸಿಗಂದೂರು ಪರಮಪವಿತ್ರ ಕ್ಷೇತ್ರದಲ್ಲಿ, ಶ್ರೀ ಸಿಗಂದೂರು ಚೌಡಮ್ಮ ದೇವಿ ಟ್ರಸ್ಟ್®ನ ಸಂಸ್ಥಾಪಕರು ಹಾಗೂ ಅಧ್ಯಕ್ಷರಾದ ಡಾ. ಶ್ರೀ ಎಸ್. ರಾಮಪ್ಪಜೀ ಅವರ ಶುಭಹಸ್ತಗಳಿಂದ ಸಂಸ್ಥೆಯ ಅಧಿಕೃತ ವೆಬ್‌ಸೈಟ್ ಲೋಕಾರ್ಪಣೆಗೊಂಡಿತು.',
                ],
                'body' => [
                    'en' => $this->bodyEn(),
                    'kn' => $this->bodyKn(),
                ],
                'location' => [
                    'en' => "Shree Sigandur Kshetra\nSigandur, Sagara Taluk\nShivamogga District, Karnataka",
                    'kn' => "ಶ್ರೀ ಸಿಗಂದೂರು ಕ್ಷೇತ್ರ\nಸಿಗಂದೂರು, ಸಾಗರ ತಾಲೂಕು\nಶಿವಮೊಗ್ಗ ಜಿಲ್ಲೆ, ಕರ್ನಾಟಕ",
                ],
                'starts_at' => '2026-08-02',
                'video' => '/videos/website-launch-sigandur.mp4',
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
<p>ಭಗವಾನ್ ಶ್ರೀ ನಾರಾಯಣ ಗುರುಗಳ ದಿವ್ಯ ಆಶೀರ್ವಾದದೊಂದಿಗೆ, ಶ್ರೀ ಗೋಕರ್ಣನಾಥ ಕ್ಷೇತ್ರ, ಕುದ್ರೋಳಿಯಲ್ಲಿ ಮಹಾಗುರುವಿನ ದಿವ್ಯ ಸಾನಿಧ್ಯದಲ್ಲಿ ವಿಶೇಷ ಪೂಜೆ ಸಲ್ಲಿಸಿದ ಬಳಿಕ, <strong>ಶ್ರೀ ನಾರಾಯಣ ಗುರು ಸ್ಕೂಲ್ ಆಫ್ ಆರ್ಟ್, ಮಂಗಳೂರು</strong> ಸಂಸ್ಥೆಯ ಅಧಿಕೃತ ವೆಬ್‌ಸೈಟ್ ಅನ್ನು ಶ್ರೀ ಸಿಗಂದೂರು ಚೌಡೇಶ್ವರಿ ದೇವಸ್ಥಾನದ ಧರ್ಮದರ್ಶಿಗಳು, ಶ್ರೀ ಸಿಗಂದೂರು ಚೌಡಮ್ಮ ದೇವಿ ಟ್ರಸ್ಟ್®ನ ಸಂಸ್ಥಾಪಕರು ಹಾಗೂ ಅಧ್ಯಕ್ಷರಾದ <strong>ಡಾ. ಶ್ರೀ ಎಸ್. ರಾಮಪ್ಪಜೀ</strong> ಅವರ ಶುಭಹಸ್ತಗಳಿಂದ ಸಿಗಂದೂರು ಪರಮಪವಿತ್ರ ಕ್ಷೇತ್ರದಲ್ಲಿ ಲೋಕಾರ್ಪಣೆ ಮಾಡಲಾಯಿತು.</p>

<p>ಈ ಸಂದರ್ಭದಲ್ಲಿ ಶ್ರೀ ಸಿಗಂದೂರು ಕ್ಷೇತ್ರದ ಪ್ರಧಾನ ಕಾರ್ಯದರ್ಶಿಗಳಾದ ಶ್ರೀ ರವಿಕುಮಾರ್ ಎಚ್.ಆರ್., ಸಾಗರ ಪಶುವೈದ್ಯಕೀಯ ನಾಮನಿರ್ದೇಶಕ ಸದಸ್ಯರಾದ ಶ್ರೀ ಜಾಕಿ ಗಣೇಶ್, ಶ್ರೀ ರಾಘವೇಂದ್ರ ಬೆಳಮಕ್ಕಿ, ಶ್ರೀ ಚಂದ್ರಪ್ಪ ಮಾಸ್ಟರ್ (ಅಳೂರು) ಹಾಗೂ ಕ್ಷೇತ್ರದ ಮ್ಯಾನೇಜರ್ ಶ್ರೀ ಪ್ರಕಾಶ್ ಉಪಸ್ಥಿತರಿದ್ದರು.</p>

<p>ಈ ವೆಬ್‌ಸೈಟ್ ಮೂಲಕ ಚಿತ್ರಕಲಾ ಶಿಕ್ಷಣ, ಚಿತ್ರಕಲಾ ತರಬೇತಿ, ಸ್ಪರ್ಧೆಗಳು, ಪ್ರದರ್ಶನಗಳು, ಪ್ರಮಾಣಪತ್ರಗಳು ಹಾಗೂ ಸಂಸ್ಥೆಯ ವಿವಿಧ ಕಲಾ ಚಟುವಟಿಕೆಗಳ ಮಾಹಿತಿಯನ್ನು ಎಲ್ಲರಿಗೂ ಸುಲಭವಾಗಿ ತಲುಪಿಸುವ ಮಹತ್ವದ ಹೆಜ್ಜೆಯನ್ನು ಇಡಲಾಗಿದೆ.</p>

<p>ಈ ಹೊಸ ಪ್ರಯತ್ನಕ್ಕೆ ನಿಮ್ಮೆಲ್ಲರ ಪ್ರೋತ್ಸಾಹ, ಸಹಕಾರ ಮತ್ತು ಶುಭಹಾರೈಕೆಗಳನ್ನು ಹೃತ್ಪೂರ್ವಕವಾಗಿ ಕೋರುತ್ತೇವೆ.</p>

<h3>ವಿಶೇಷ ಧನ್ಯವಾದಗಳು</h3>
<p>ಶ್ರೀ ಸಿಗಂದೂರು ಕ್ಷೇತ್ರದ ಪ್ರಧಾನ ಕಾರ್ಯದರ್ಶಿಗಳಾದ ಶ್ರೀ ರವಿಕುಮಾರ್ ಎಚ್.ಆರ್. ಹಾಗೂ ಶ್ರೀ ಚಂದ್ರಪ್ಪ ಮಾಸ್ಟರ್ (ಅಳೂರು) ಅವರಿಗೆ ಹೃತ್ಪೂರ್ವಕ ಕೃತಜ್ಞತೆಗಳು.</p>

<p><strong>ಸುರೇಶ್ ಕೆ. ಪಾಂಡವರಕಲ್ಲು</strong><br>
ಸಂಸ್ಥಾಪಕರು ಮತ್ತು ನಿರ್ದೇಶಕರು<br>
ಶ್ರೀ ನಾರಾಯಣ ಗುರು ಸ್ಕೂಲ್ ಆಫ್ ಆರ್ಟ್, ಮಂಗಳೂರು</p>

<p>ಮೊಬೈಲ್: 9483024279 / 9448549279</p>

<p><em>"ಕಲೆ ಎಲ್ಲರಿಗಾಗಿ – ಪ್ರತಿಭೆಗೆ ಯಾವುದೇ ಗಡಿಗಳಿಲ್ಲ."</em></p>
HTML;
    }

    private function bodyEn(): string
    {
        return <<<'HTML'
<p>With the divine blessings of Bhagavan Shree Narayana Guru, and following a special puja in the Mahaguru's sacred presence at Shree Gokarnanatha Kshetra, Kudroli, the official website of <strong>Shree Narayana Guru School of Art, Mangaluru</strong> was launched at the sacred Sigandur kshetra by <strong>Dr. Sri S. Ramappaji</strong> — dharmadarshi of the Sri Sigandur Chowdeshwari Temple and founder and president of the Sri Sigandur Chowdamma Devi Trust®.</p>

<p>Present on the occasion were Sri Ravikumar H. R., chief secretary of the Sigandur kshetra; Sri Jacky Ganesh, nominated member of Sagara Veterinary; Sri Raghavendra Belamakki; Sri Chandrappa Master (Aluru); and Sri Prakash, manager of the kshetra.</p>

<p>The website is a significant step towards bringing information about art education, art training, competitions, exhibitions, certificates and the institution's many artistic activities within easy reach of everyone.</p>

<p>We warmly invite your encouragement, co-operation and good wishes for this new endeavour.</p>

<h3>With special thanks</h3>
<p>Heartfelt gratitude to Sri Ravikumar H. R., chief secretary of the Sigandur kshetra, and to Sri Chandrappa Master (Aluru).</p>

<p><strong>Suresh K. Pandavarakallu</strong><br>
Founder &amp; Director<br>
Shree Narayana Guru School of Art, Mangaluru</p>

<p>Mobile: 9483024279 / 9448549279</p>

<p><em>"Art is for everyone — talent knows no boundaries."</em></p>
HTML;
    }
};
