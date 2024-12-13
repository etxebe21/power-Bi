import React, { useState } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function ProyectosIndex({ proyectos }) {
    const [selectedEdificio, setSelectedEdificio] = useState({});
    const [selectedVivienda, setSelectedVivienda] = useState({});

    const handleEdificioChange = (proyectoId, event) => {
        setSelectedEdificio({
            ...selectedEdificio,
            [proyectoId]: event.target.value,
        });
        setSelectedVivienda({ ...selectedVivienda, [proyectoId]: null }); // Reset vivienda
    };

    const handleViviendaChange = (proyectoId, event) => {
        setSelectedVivienda({
            ...selectedVivienda,
            [proyectoId]: event.target.value,
        });
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Proyectos
                </h2>
            }
        >
            <Head title="Proyectos" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        {proyectos.map((proyecto) => (
                            <div
                                key={proyecto.ID_PROYECTO}
                                className="bg-white shadow-md rounded-lg overflow-hidden"
                            >
                                <div className="p-6">
                                    <h2 className="text-lg font-bold text-gray-800">
                                        {proyecto.NOMBRE_PROYECTO}
                                    </h2>
                                    <div className="mt-4">
                                        <label
                                            htmlFor={`edificio-select-${proyecto.ID_PROYECTO}`}
                                            className="block text-sm font-medium text-gray-700"
                                        >
                                            Seleccionar Edificio:
                                        </label>
                                        <select
                                            id={`edificio-select-${proyecto.ID_PROYECTO}`}
                                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            value={selectedEdificio[proyecto.ID_PROYECTO] || ''}
                                            onChange={(e) =>
                                                handleEdificioChange(proyecto.ID_PROYECTO, e)
                                            }
                                        >
                                            <option value="">Seleccione un edificio</option>
                                            {proyecto.edificios.map((edificio, index) => (
                                                <option key={index} value={edificio.DIRECCION}>
                                                    {edificio.DIRECCION}
                                                </option>
                                            ))}
                                        </select>
                                    </div>
                                    {selectedEdificio[proyecto.ID_PROYECTO] && (
                                        <div className="mt-4">
                                            <label
                                                htmlFor={`vivienda-select-${proyecto.ID_PROYECTO}`}
                                                className="block text-sm font-medium text-gray-700"
                                            >
                                                Seleccionar Vivienda:
                                            </label>
                                            <select
                                                id={`vivienda-select-${proyecto.ID_PROYECTO}`}
                                                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                value={selectedVivienda[proyecto.ID_PROYECTO] || ''}
                                                onChange={(e) =>
                                                    handleViviendaChange(proyecto.ID_PROYECTO, e)
                                                }
                                            >
                                                <option value="">Seleccione una vivienda</option>
                                                {proyecto.edificios
                                                    .find(
                                                        (e) =>
                                                            e.DIRECCION ===
                                                            selectedEdificio[proyecto.ID_PROYECTO]
                                                    )
                                                    ?.viviendas.map((vivienda, idx) => (
                                                        <option key={idx} value={vivienda.PISO}>
                                                            Piso {vivienda.PISO}
                                                        </option>
                                                    ))}
                                            </select>
                                        </div>
                                    )}
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
