<template>
  <canvas id="salesChart"></canvas>
</template>
<script>
import Chart from "chart.js/auto";
export default {
  name: "SalesChart",
  props: {
    labels: Array,
    values: Array,
  },

  data() {
    return {
      chartData: {
        type: "bar",
        data: {
          labels: [],
          datasets: [
            {
              label: "Total Sales",
              data: [],
              backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)",
              ],
              borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
                "rgba(255, 159, 64, 1)",
              ],
              borderWidth: 1,
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
    const salesChart = "salesChart";
    new Chart(salesChart, this.chartData);
  },
};
</script>
