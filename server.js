const fetch = require('node-fetch');

// SpoonacularのAPIキー
const apiKey = '2b48d426fe2446c6a4c085c2d6a1e3fb';
const apiUrl = 'https://api.spoonacular.com/food/ingredients/search'; // エンドポイント

// 例: 食品名を設定
const query = 'apple';

// APIリクエストを送信
fetch(${apiUrl}?query=${encodeURIComponent(query)}&apiKey=${apiKey}, {
    method: 'GET',
})
.then(response => {
    if (!response.ok) {
        throw new Error('ネットワークエラー');
    }
    return response.json();
})
.then(data => {
    // 取得したデータをコンソールに表示
    console.log(data);
})
.catch(error => {
    console.error('エラー:', error);
});