<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Colores para los gráficos
        const colors = {
            primary: '#4e73df',
            success: '#1cc88a',
            info: '#36b9cc',
            warning: '#f6c23e',
            danger: '#e74a3b',
            secondary: '#858796',
            light: '#f8f9fc'
        };

        // Gráfico de Préstamos por Estado
        const loanStatusCtx = document.getElementById('loanStatusChart');
        if (loanStatusCtx) {
            const loanStatusChart = new Chart(loanStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: {
                        !!json_encode($data['charts']['loan_status'] - > keys() - > toArray()) !!
                    },
                    datasets: [{
                        data: {
                            !!json_encode($data['charts']['loan_status'] - > values() - > toArray()) !!
                        },
                        backgroundColor: [
                            colors.primary,
                            colors.success,
                            colors.warning,
                            colors.danger,
                            colors.info,
                            colors.secondary
                        ],
                        hoverBackgroundColor: [
                            colors.primary,
                            colors.success,
                            colors.warning,
                            colors.danger,
                            colors.info,
                            colors.secondary
                        ],
                        borderWidth: 2,
                        borderColor: colors.light
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Gráfico de Recursos por Tipo
        const resourceTypeCtx = document.getElementById('resourceTypeChart');
        if (resourceTypeCtx) {
            const resourceTypeChart = new Chart(resourceTypeCtx, {
                type: 'pie',
                data: {
                    labels: {
                        !!json_encode($data['charts']['resource_types'] - > keys() - > toArray()) !!
                    },
                    datasets: [{
                        data: {
                            !!json_encode($data['charts']['resource_types'] - > values() - > toArray()) !!
                        },
                        backgroundColor: [
                            colors.primary,
                            colors.success,
                            colors.info,
                            colors.warning,
                            colors.danger,
                            colors.secondary
                        ],
                        hoverBackgroundColor: [
                            colors.primary,
                            colors.success,
                            colors.info,
                            colors.warning,
                            colors.danger,
                            colors.secondary
                        ],
                        borderWidth: 2,
                        borderColor: colors.light
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Gráfico de Usuarios por Rol
        const userRoleCtx = document.getElementById('userRoleChart');
        if (userRoleCtx) {
            const userRoleChart = new Chart(userRoleCtx, {
                type: 'bar',
                data: {
                    labels: {
                        !!json_encode($data['charts']['user_roles'] - > keys() - > toArray()) !!
                    },
                    datasets: [{
                        label: 'Usuarios',
                        data: {
                            !!json_encode($data['charts']['user_roles'] - > values() - > toArray()) !!
                        },
                        backgroundColor: colors.primary,
                        borderColor: colors.primary,
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        }

        // Gráfico de Préstamos Mensuales
        const monthlyLoansCtx = document.getElementById('monthlyLoansChart');
        if (monthlyLoansCtx) {
            const monthlyLoansChart = new Chart(monthlyLoansCtx, {
                type: 'line',
                data: {
                    labels: {
                        !!json_encode(array_keys($data['charts']['monthly_loans'])) !!
                    },
                    datasets: [{
                        label: 'Préstamos',
                        data: {
                            !!json_encode(array_values($data['charts']['monthly_loans'])) !!
                        },
                        backgroundColor: 'rgba(78, 115, 223, 0.1)',
                        borderColor: colors.primary,
                        borderWidth: 2,
                        pointBackgroundColor: colors.primary,
                        pointBorderColor: colors.light,
                        pointRadius: 4,
                        tension: 0.3
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        }
    });
</script>