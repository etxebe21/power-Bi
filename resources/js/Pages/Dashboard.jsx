import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';
import styled from 'styled-components';

// Estilos para el contenedor del botón
const ButtonContainer = styled.div`
    margin-top: 1rem;
`;

// Estilos para el botón
const StyledButton = styled(Link)`
    display: inline-block;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #fff;
    background-color: #3b82f6;
    border-radius: 0.375rem;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.2s;

    &:hover {
        background-color: #2563eb;
    }
`;

export default function Dashboard() {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <p>You're logged in!</p>

                            {/* Botón estilizado con styled-components */}
                            <ButtonContainer>
                                <StyledButton href="/proyectos">
                                    Ver Proyectos
                                </StyledButton>
                            </ButtonContainer>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
