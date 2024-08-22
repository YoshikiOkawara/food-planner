<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>食品データ検索</title>
    <style>
        .food-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .food-item h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <h1>食品データ検索</h1>
    <input type="text" id="foodQuery" placeholder="食品名を入力">
    <button id="searchBtn">検索</button>
    <div id="results"></div>

    <script>
        // 取得したAPIキーとIDを変数に格納
        const appId = '2e51e67c';
        const apiKey = '3a559ad46f2fc201e0b6bbda9aba524f';
        const apiUrl = 'https://trackapi.nutritionix.com/v2/search/instant';

        document.getElementById('searchBtn').addEventListener('click', function() {
            const query = document.getElementById('foodQuery').value.trim();

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
                    throw new Error('ネットワークエラー');
                }
                return response.json();
            })
            .then(data => {
                // 取得したデータを画面に表示
                const resultsDiv = document.getElementById('results');
                resultsDiv.innerHTML = ''; // 既存の内容をクリア

                if (data && data.common && data.common.length > 0) {
                    data.common.forEach(food => {
                        const foodItem = `
                            <div class="food-item">
                                <h3>${food.food_name}</h3>
                                <p><strong>カロリー:</strong> ${food.nf_calories || '不明'} kcal</p>
                                <p><strong>炭水化物:</strong> ${food.nf_total_carbohydrate || '不明'} g</p>
                                <p><strong>タンパク質:</strong> ${food.nf_protein || '不明'} g</p>
                                <p><strong>脂質:</strong> ${food.nf_total_fat || '不明'} g</p>
                                <p><strong>ビタミン:</strong> ${food.nf_vitamin_a || '不明'} IU</p>
                                <p><strong>ミネラル:</strong> ${food.nf_sodium || '不明'} mg</p>
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
    </script>
</body>
</html>
