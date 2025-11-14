@php
    $loanStatus = isset($data['charts']['loan_status']) ? collect($data['charts']['loan_status']) : collect(['pendiente' => 7, 'aprobado' => 4, 'activo' => 6, 'completado' => 3, 'cancelado' => 1]);
    $resourceTypes = isset($data['charts']['resource_types']) ? collect($data['charts']['resource_types']) : collect(['Laptops' => 12, 'Tablets' => 5, 'Cámaras' => 3, 'Accesorios' => 9]);
    $userRoles = isset($data['charts']['user_roles']) ? collect($data['charts']['user_roles']) : collect(['admin' => 1, 'staff' => 1, 'estudiante' => 1, 'profesor' => 1]);
    $monthlyLoans = isset($data['charts']['monthly_loans']) ? (is_array($data['charts']['monthly_loans']) ? $data['charts']['monthly_loans'] : $data['charts']['monthly_loans']->toArray()) : ['Ene' => 2, 'Feb' => 3, 'Mar' => 1, 'Abr' => 4, 'May' => 2, 'Jun' => 3, 'Jul' => 2, 'Ago' => 4, 'Sep' => 3, 'Oct' => 5, 'Nov' => 2, 'Dic' => 1];
@endphp
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
                    labels: {!! json_encode($loanStatus->keys()->toArray()) !!},
                    datasets: [{
                        data: {!! json_encode($loanStatus->values()->toArray()) !!},
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
                    labels: {!! json_encode($resourceTypes->keys()->toArray()) !!},
                    datasets: [{
                        data: {!! json_encode($resourceTypes->values()->toArray()) !!},
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
                    labels: {!! json_encode($userRoles->keys()->toArray()) !!},
                    datasets: [{
                        label: 'Usuarios',
                        data: {!! json_encode($userRoles->values()->toArray()) !!},
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
                    labels: {!! json_encode(array_keys($monthlyLoans)) !!},
                    datasets: [{
                        label: 'Préstamos',
                        data: {!! json_encode(array_values($monthlyLoans)) !!},
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