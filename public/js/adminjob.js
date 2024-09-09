function updateSalaryOptions() {
    const salaryType = document.getElementById('salary_type').value;
    const minSalary = document.getElementById('min_salary');
    const maxSalary = document.getElementById('max_salary');

    // Clear existing options
    minSalary.innerHTML = '<option value="">選択してください</option>';
    maxSalary.innerHTML = '<option value="">選択してください</option>';

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
            minSalary.appendChild(optionMin);

            const optionMax = document.createElement('option');
            optionMax.value = value;
            optionMax.textContent = value.toLocaleString() + (salaryType === '時給' ? '円' : '円');
            maxSalary.appendChild(optionMax);
        });
    }
}