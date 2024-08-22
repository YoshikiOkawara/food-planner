document.addEventListener('DOMContentLoaded', function () {
    // 消費期限と賞味期限の入力フィールドを取得
    const expirationDateInput = document.getElementById('expiration_date');
    const bestBeforeDateInput = document.getElementById('best_before_date');
    
    // 入力フィールドが存在する場合のみ処理を実行
    if (expirationDateInput && bestBeforeDateInput) {
        const expirationDate = new Date(expirationDateInput.value);
        const bestBeforeDate = new Date(bestBeforeDateInput.value);
        const today = new Date();

        // 期限が7日以内かどうかをチェック
        const daysUntilExpiration = Math.floor((expirationDate - today) / (1000 * 60 * 60 * 24));
        const daysUntilBestBefore = Math.floor((bestBeforeDate - today) / (1000 * 60 * 60 * 24));

        if (daysUntilExpiration <= 7 && daysUntilExpiration >= 0) {
            alert(`消費期限が近づいています！残り ${daysUntilExpiration} 日です。`);
        }

        if (daysUntilBestBefore <= 7 && daysUntilBestBefore >= 0) {
            alert(`賞味期限が近づいています！残り ${daysUntilBestBefore} 日です。`);
        }
    }
});
