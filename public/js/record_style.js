<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    <script>
        const benchPressData = @json($benchPressData);

        const ctx1 = document.getElementById('benchPressChart').getContext('2d');
        const benchPressChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: benchPressData.dates.map(date => date.split(' ')[0]), // 日付のラベル
                datasets: [{
                    label: 'Bench Press (kg)',
                    data: benchPressData.bench, // ベンチプレスの重量
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const deadData = @json($deadData);

        const ctx2 = document.getElementById('deadChart').getContext('2d');
        const deadChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: deadData.dates.map(date => date.split(' ')[0]), // 日付のラベル
                datasets: [{
                    label: 'Dead (kg)',
                    data: deadData.dead, // ベンチプレスの重量
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const squatData = @json($squatData);

        const ctx3 = document.getElementById('squatChart').getContext('2d');
        const squatChart = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: squatData.dates.map(date => date.split(' ')[0]), // 日付のラベル
                datasets: [{
                    label: 'Squat (kg)',
                    data: squatData.squat, // ベンチプレスの重量
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
