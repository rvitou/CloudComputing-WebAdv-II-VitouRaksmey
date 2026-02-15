<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create([
            'name' => 'Cambodia',
            'slug' => 'cambodia',
            'flag_image_path' => 'img/flags/cambodia.svg',
            'description' => 'The Kingdom of Cambodia is a culturally rich Southeast Asian country known for its ancient temples, historical legacy, and resilient people. The country is home to the world-famous Angkor Wat, a UNESCO World Heritage site, symbolizing the peak of the Khmer Empire. Cambodia’s economy is largely based on textiles, agriculture, and tourism, and it is gradually embracing digital development and financial technologies. The official currency is the Khmer Riel (KHR), which was introduced in 1955 to replace the Indochinese piastre. After the Khmer Rouge regime abolished money in the late 1970s, the Riel was reintroduced in 1980. While the U.S. dollar is still widely used in daily transactions, the Cambodian government has actively promoted de-dollarization to strengthen the use of its national currency, reflecting both a symbolic and practical step toward economic sovereignty.',
            'main_currency_image_path' => 'img/Currencies/khmer riel/max.jpg',
        ]);

        Country::create([
            'name' => 'China',
            'slug' => 'china',
            'flag_image_path' => 'img/flags/china.webp',
            'description' => 'China, officially known as the People\'s Republic of China, is the most populous country in the world and has one of the oldest continuous civilizations, with a history spanning over 5,000 years. Its rapid modernization and economic growth in the past few decades have transformed it into a global economic powerhouse. The official currency is the Renminbi (RMB), with the yuan (CNY) as its primary unit. The Renminbi was first introduced in 1948 by the People’s Bank of China, just before the founding of the PRC. Over the years, the currency has undergone several reforms to combat inflation, with significant milestones including the removal of dual exchange rates in the 1990s and recent digital yuan (e-CNY) pilot projects. Today, China’s currency is increasingly used in international trade, and the country is pushing for it to gain global reserve currency status, which reflects China’s ambition to reshape global financial systems.',
            'main_currency_image_path' => 'img/Currencies/chinese yuan/Renminbi_banknotes.jpg',
        ]);

        Country::create([
            'name' => 'Vietnam',
            'slug' => 'vietnam',
            'flag_image_path' => 'img/flags/vietnam.png',
            'description' => 'Vietnam is a vibrant Southeast Asian country with a rich history shaped by centuries of dynasties, colonial influence, and revolutionary struggles. Known for its stunning natural landscapes and delicious cuisine, Vietnam has emerged as one of Asia’s fastest-growing economies. Its official currency is the Vietnamese Dong (VND), first introduced in 1978 after the reunification of North and South Vietnam. The currency replaced the Northern dong and Southern liberation dong at different rates, symbolizing national unity. Over the years, Vietnam has kept the Dong relatively stable, although it remains one of the lowest-valued currencies in the world in nominal terms. Despite this, the dong plays a critical role in facilitating Vietnam’s booming export-driven economy, particularly in electronics, agriculture, and textiles. The Vietnamese government continues to modernize its financial infrastructure, with the dong being essential in everyday life, trade, and digital finance.',
            'main_currency_image_path' => 'img/Currencies/vietnamese dong/max.jpg',
        ]);

        Country::create([
            'name' => 'Thailand',
            'slug' => 'thailand',
            'flag_image_path' => 'img/flags/thailand.png',
            'description' => 'Thailand is a constitutional monarchy in Southeast Asia, known for its tropical beaches, ornate temples, vibrant street life, and rich cultural heritage. A regional hub for tourism and commerce, Thailand plays a vital role in the ASEAN economy. The national currency is the Thai Baht (THB), which was historically backed by silver. The baht was decimalized in the late 19th century, and since then, it has evolved into a stable and well-managed currency. The Bank of Thailand has maintained a relatively strong monetary policy, and the baht has shown resilience even during economic crises like the 1997 Asian Financial Crisis. In recent years, Thailand has promoted the digital baht and fintech innovation. The currency is widely used not only for domestic consumption but also in regional trade, underscoring Thailand’s importance in global supply chains and tourism.',
            'main_currency_image_path' => 'img/Currencies/thai baht/max.webp',
        ]);

        Country::create([
            'name' => 'USA',
            'slug' => 'usa',
            'flag_image_path' => 'img/flags/usa.png',
            'description' => 'The United States of America is a vast and diverse nation comprising 50 states and is one of the most influential countries in the world in terms of politics, economy, and culture. The official currency is the United States Dollar (USD), one of the most widely used and trusted currencies globally. Introduced in 1792, the U.S. dollar has undergone multiple redesigns and reforms, becoming the world’s leading reserve currency after World War II due to the Bretton Woods Agreement. Today, the dollar is used in international trade, foreign exchange reserves, and as a standard for commodities like gold and oil. The U.S. Treasury and the Federal Reserve manage its issuance and monetary policy, and it is considered a benchmark of global financial stability. The strength and influence of the dollar play a critical role in global economics, investment, and diplomacy.',
            'main_currency_image_path' => 'img/Currencies/us dollar/max.avif',
        ]);

        $this->command->info('Countries seeded successfully!');
    }
}
