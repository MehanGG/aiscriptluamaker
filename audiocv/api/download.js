export default async function handler(req, res) {
    const { url } = req.query;
    if (!url) {
        return res.status(400).json({ ok: false, message: "URL parameter tidak ditemukan" });
    }

    const apiHost = 'instagram-tiktok-youtube-downloader.p.rapidapi.com';
    const apiKey = 'c2add32f3emsh16710cb3366f60cp1673cfjsnb077d89c650f';
    const targetUrl = `https://${apiHost}/fetch?url=` + encodeURIComponent(url);

    try {
        const response = await fetch(targetUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'x-rapidapi-host': apiHost,
                'x-rapidapi-key': apiKey
            }
        });

        const data = await response.json();
        
        // Header CORS untuk mengizinkan akses dari frontend
        res.setHeader('Access-Control-Allow-Origin', '*');
        return res.status(200).json(data);
    } catch (error) {
        return res.status(500).json({ ok: false, message: error.message });
    }
}
