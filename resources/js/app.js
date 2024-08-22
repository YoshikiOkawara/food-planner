// 取得したAPIキーとIDを変数に格納
const appId = '2e51e67c';
const apiKey = '3a559ad46f2fc201e0b6bbda9aba524f';
const apiUrl = 'https://trackapi.nutritionix.com/v2/search/instant'; // 正しいエンドポイントに変更

document.getElementById('searchBtn').addEventListener('click', function() {
    const query = document.getElementById('foodQuery').value;

    if (!query) {
        alert('食品名を入力してください。');
        return;
    }

    // APIリクエストを送信
    fetch(`${apiUrl}?query=${encodeURIComponent(query)}`, {
        method: 'GET',
        headers: {
            'x-app-id': appId,
            'x-app-key': apiKey,
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('ネットワーク応答が正常ではありません。');
        }
        return response.json();
    })
    .then(data => {
        // 取得したデータをコンソールに表示
        console.log('APIレスポンスデータ:', data);

        // 取得したデータを画面に表示
        const resultsDiv = document.getElementById('results');
        resultsDiv.innerHTML = ''; // 既存の内容をクリア

        if (data && data.foods) {
            data.foods.forEach(food => {
                const foodItem = `
                    <div class="food-item">
                        <h3>${food.food_name}</h3>
                        <p><strong>カロリー:</strong> ${food.nf_calories} kcal</p>
                        <p><strong>炭水化物:</strong> ${food.nf_total_carbohydrate} g</p>
                        <p><strong>タンパク質:</strong> ${food.nf_protein} g</p>
                        <p><strong>脂質:</strong> ${food.nf_total_fat} g</p>
                        <p><strong>ビタミン:</strong> ${food.nf_vitamin_a} IU</p>
                        <p><strong>ミネラル:</strong> ${food.nf_sodium} mg</p>
                    </div>
                `;
                resultsDiv.innerHTML += foodItem;
            });
        } else {
            resultsDiv.innerHTML = '<p>データが見つかりませんでした。</p>';
        }
    })
    .catch(error => {
        console.error('エラー:', error);
        alert('データを取得できませんでした。もう一度お試しください。');
    });
});
