import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Lecturas({ lecturas }) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    LECTURAS
                </h2>
            }
        >
            <Head title="Lecturas" />

            <div className="p-6 bg-gray-100">
                <h3 className="text-lg font-bold mb-4">Listado de Lecturas</h3>

                {/* {lecturas && lecturas.length > 0 ? (
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {lecturas.map((lectura) => (
                            <div key={lectura.ID_lectura} className="bg-white shadow-md rounded-lg p-4">
                                <h4 className="text-md font-bold text-blue-700 mb-2">
                                    {lectura.DESCRIPCION || 'lectura sin descripción'}
                                </h4>
                                <p><strong>ID lectura:</strong> {lectura.ID_LECTURA}</p>
                                <p><strong>Descripción:</strong> {lectura.DESCRIPCION}</p>
                                <p><strong>ID Vivienda:</strong> {lectura.ID_VIVIENDA}</p>
                                <p><strong>Dirección:</strong> {lectura.DIRECCION}</p>
                                <p><strong>ID Proyecto:</strong> {lectura.ID_PROYECTO}</p>
                                <p><strong>ID Edificio:</strong> {lectura.ID_EDIFICIO}</p>
                                <p><strong>Proyecto:</strong> {lectura.NOMBRE_PROYECTO}</p>
                                <p><strong>Última Lectura:</strong> {lectura.ULTIMA_LECTURA}</p>
                            </div>
                        ))}
                    </div>
                ) : (
                    <p className="text-gray-500">No hay lecturaes disponibles.</p>
                )} */}
            </div>
        </AuthenticatedLayout>
    );
}
