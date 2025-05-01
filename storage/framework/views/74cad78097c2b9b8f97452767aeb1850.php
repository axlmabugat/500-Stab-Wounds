

<?php $__env->startSection('content'); ?>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<style>
    body {
        background: linear-gradient(135deg, #e0e5ec 0%, #f5f7fa 100%) !important;
        color: #222831;
        font-family: 'Roboto', Arial, sans-serif;
    }
    .neo-container {
        padding-top: 32px;
        padding-bottom: 32px;
    }
    .neo-card {
        background: #e0e5ec;
        border-radius: 24px;
        box-shadow: 8px 8px 24px #b8bac0, -8px -8px 24px #ffffff;
        color: #222831;
        transition: box-shadow 0.3s, transform 0.2s;
        margin-bottom: 24px;
    }
    .neo-card:hover {
        box-shadow: 4px 4px 12px #b8bac0, -4px -4px 12px #ffffff, 0 0 0 4px #00adb5;
        transform: translateY(-4px) scale(1.01);
    }
    .neo-title {
        font-family: 'Montserrat', Arial, sans-serif;
        font-size: 1.3rem;
        color: #00adb5;
        margin-bottom: 0.5rem;
        letter-spacing: 1px;
        font-weight: 700;
    }
    .neo-text {
        font-size: 2rem;
        font-weight: 700;
        color: #393e46;
        letter-spacing: 1px;
    }
    .neo-card ul li {
        color: #393e46;
        font-weight: 500;
    }
    .neo-chart-bg {
        background: #e0e5ec;
        border-radius: 18px;
        box-shadow: 6px 6px 18px #b8bac0, -6px -6px 18px #ffffff;
        padding: 24px;
        margin-bottom: 24px;
    }
    .SPEED-RACER {
        margin-top: 40px;
        text-align: center;
        font-family: 'Montserrat', Arial, sans-serif;
        color: #00adb5;
        font-size: 1.1rem;
        letter-spacing: 1px;
        background: #e0e5ec;
        border-radius: 16px;
        box-shadow: 4px 4px 12px #b8bac0, -4px -4px 12px #ffffff;
        padding: 18px 24px;
        display: inline-block;
        margin-left: auto;
        margin-right: auto;
        font-style: italic;
    }
</style>

<div class="container neo-container">
    <div class="row mb-4">
        <div class="col">
            <div class="neo-card p-4">
                <div class="card-body">
                    <h5 class="neo-title">Total Sales</h5>
                    <p class="neo-text"><?php echo e(number_format($totalSales, 2)); ?></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="neo-card p-4">
                <div class="card-body">
                    <h5 class="neo-title">Overall Units Sold</h5>
                    <p class="neo-text"><?php echo e($overallSalesCount); ?></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="neo-card p-4">
                <div class="card-body">
                    <h5 class="neo-title">Product Count per Region</h5>
                    <ul>
                        <?php $__currentLoopData = $productCountPerRegion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($region); ?>: <?php echo e($count); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col neo-chart-bg">
            <canvas id="lineChart"></canvas>
        </div>
        <div class="col neo-chart-bg">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <div class="SPEED-RACER">
        “Here he comes, here comes Speed Racer
He's a demon on wheels
He's a demon and he's gonna be chasing after someone
He's gaining on you so you'd better look alive
He's busy revving up the powerful Mach 5
And when the odds are against him and there's dangerous work to do
You bet your life Speed Racer will see it through
Go Speed Racer!
Go Speed Racer!
Go Speed Racer Go!
He's off and flying as he guns the car around the track
He's jamming down the pedal like he's never coming back
Adventure's waiting just ahead
Go Speed Racer!
Go Speed Racer!
Go Speed Racer Go!.”<br>
        - VROOOOM! VROOOOM!<br>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('lineChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_keys($productsSoldPerMonth->toArray())); ?>,
            datasets: [{
                label: 'Products Sold per Month',
                data: <?php echo json_encode(array_values($productsSoldPerMonth->toArray())); ?>,
                borderColor: '#00adb5',
                backgroundColor: 'rgba(0, 173, 181, 0.12)',
                pointBackgroundColor: '#393e46',
                pointBorderColor: '#00adb5',
                pointRadius: 6,
                pointHoverRadius: 8,
                fill: true,
                tension: 0.35,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#b8bac0' },
                    ticks: { color: '#393e46' }
                },
                x: {
                    grid: { color: '#b8bac0' },
                    ticks: { color: '#393e46' }
                }
            },
            plugins: {
                legend: {
                    labels: { color: '#00adb5' }
                }
            }
        }
    });

    new Chart(document.getElementById('barChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_keys($productsSoldPerRegion->toArray())); ?>,
            datasets: [{
                label: 'Products Sold per Region',
                data: <?php echo json_encode(array_values($productsSoldPerRegion->toArray())); ?>,
                backgroundColor: '#00adb5',
                borderColor: '#393e46',
                borderWidth: 2,
                hoverBackgroundColor: '#393e46',
                hoverBorderColor: '#00adb5',
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#b8bac0' },
                    ticks: { color: '#393e46' }
                },
                x: {
                    grid: { color: '#b8bac0' },
                    ticks: { color: '#393e46' }
                }
            },
            plugins: {
                legend: {
                    labels: { color: '#00adb5' }
                }
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\500-STAB-WOUNDS\resources\views/dashboard.blade.php ENDPATH**/ ?>