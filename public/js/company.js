document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('company_form');
    const submitButton = document.getElementById('submitButton');
    const messagediv = document.getElementById('message');

    form.addEventListener('submit', (e) => {
        e.preventDefault(); //デフォルトのフォーム送信を防ぐ

        submitButton.disabled = true; //送信中はボタンを無効化
        messagediv.textContent = '送信中';

        const formdata = new FormData();

        fetch(form.ariaDescription, {
            method: 'POST',
            body: formdata,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })

        .then(response => response.json())
        .then(data => {
            if(data.success) {
                messagediv.textContent = '企業情報が正常に登録されました。';
                form.reset();
            } else {
                messagediv.textContent = 'エラーが発生しました: ' + data.message;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            messagediv.textContent = 'エラーが発生しました。もう一度お試しください。';
        })
        .finally(() => {
            submitButton.disabled = false; // 送信完了後にボタンを再度有効化
        });
    });
});