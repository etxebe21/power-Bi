import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Medidores({ medidores }) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Medidores
                </h2>
            }
        >
            <Head title="Medidores" />

            <div className="p-6 bg-gray-100">
                <h3 className="text-lg font-bold mb-4">Listado de Medidores</h3>

                {medidores && medidores.length > 0 ? (
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {medidores.map((medidor) => (
                            <div key={medidor.ID_MEDIDOR} className="bg-white shadow-md rounded-lg p-4">
                                <h4 className="text-md font-bold text-blue-700 mb-2">
                                    {medidor.DESCRIPCION || 'Medidor sin descripción'}
                                </h4>
                                <p><strong>ID Medidor:</strong> {medidor.ID_MEDIDOR}</p>
                                <p><strong>Descripción:</strong> {medidor.DESCRIPCION}</p>
                                <p><strong>ID Vivienda:</strong> {medidor.ID_VIVIENDA}</p>
                                <p><strong>Dirección:</strong> {medidor.DIRECCION}</p>
                                <p><strong>ID Proyecto:</strong> {medidor.ID_PROYECTO}</p>
                                <p><strong>ID Edificio:</strong> {medidor.ID_EDIFICIO}</p>
                                <p><strong>Proyecto:</strong> {medidor.NOMBRE_PROYECTO}</p>
                                <p><strong>Última Lectura:</strong> {medidor.ULTIMA_LECTURA}</p>
                            </div>
                        ))}
                    </div>
                ) : (
                    <p className="text-gray-500">No hay medidores disponibles.</p>
                )}
            </div>
        </AuthenticatedLayout>
    );
}
