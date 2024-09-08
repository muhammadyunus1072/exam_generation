<div class="{!! $containerClass !!}" style="{!! $containerStyle !!}" wire:ignore>
    <canvas id="{{ $canvasId }}"></canvas>
</div>

@script
    <script>
        const config = @json($config);
        const chart = new Chart(document.getElementById('{{ $canvasId }}'), config);

        $wire.on('js-chart-update', (data) => {
            chart.data.datasets = data.datasets;
            chart.data.labels = data.labels;
            chart.update();
        });
    </script>
@endscript
