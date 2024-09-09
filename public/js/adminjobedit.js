document.addEventListener('DOMContentLoaded', function() {
    const salaryTypeSelect = document.getElementById('salary_type');
    const minSalarySelect = document.getElementById('min_salary');
    const maxSalarySelect = document.getElementById('max_salary');

    function updateSalaryOptions() {
        const salaryType = salaryTypeSelect.value;
        
        // Clear existing options
        minSalarySelect.innerHTML = '<option value="">選択してください</option>';
        maxSalarySelect.innerHTML = '<option value="">選択してください</option>';

        let options;
        if (salaryType === '時給') {
            options = [800, 850, 900, 950, 1000, 1100, 1200, 1300, 1400, 1500, 2000];
        } else if (salaryType === '日給') {
            options = [8000, 9000, 10000, 11000, 12000, 13000, 14000, 15000, 16000, 17000, 18000];
        } else if (salaryType === '月給') {
            options = [150000, 160000, 170000, 180000, 190000, 200000, 220000, 240000, 260000, 280000, 300000, 350000, 400000];
        }

        if (options) {
            options.forEach(value => {
                const optionMin = document.createElement('option');
                optionMin.value = value;
                optionMin.textContent = value.toLocaleString() + (salaryType === '時給' ? '円' : '円');
                minSalarySelect.appendChild(optionMin);

                const optionMax = document.createElement('option');
                optionMax.value = value;
                optionMax.textContent = value.toLocaleString() + (salaryType === '時給' ? '円' : '円');
                maxSalarySelect.appendChild(optionMax);
            });
        }

        // 既存の値を選択状態にする
        if (minSalarySelect.dataset.value) {
            minSalarySelect.value = minSalarySelect.dataset.value;
        }
        if (maxSalarySelect.dataset.value) {
            maxSalarySelect.value = maxSalarySelect.dataset.value;
        }
    }

    // 給与タイプが変更されたときにオプションを更新
    salaryTypeSelect.addEventListener('change', updateSalaryOptions);

    // ページ読み込み時に初期値を設定
    updateSalaryOptions();
});

const checkbox = document.getElementById('switch');
checkbox.addEventListener('click', () => {
  const title = document.querySelector('.title');
  title.textContent = checkbox.checked ? '公開' : '非公開';
});