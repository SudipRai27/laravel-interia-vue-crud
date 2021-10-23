<template>
  <canvas id="customersChart"></canvas>
</template>
<script>
import Chart from "chart.js/auto";
export default {
  name: "CustomersChart",
  props: {
    labels: Array,
    values: Array,
  },

  data() {
    return {
      chartData: {
        type: "line",
        data: {
          labels: [],
          datasets: [
            {
              label: "Customers Chart",
              data: [],
              fill: false,
              borderColor: "rgb(75, 192, 192)",
              tension: 0.1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
          maintainAspectRatio: false,
          responsive: true,
        },
      },
    };
  },
  components: {
    Chart,
  },

  mounted() {
    this.chartData.data.labels = this.labels;
    this.chartData.data.datasets[0].data = this.values;
    const customersChart = "customersChart";
    new Chart(customersChart, this.chartData);
  },
};
</script>
