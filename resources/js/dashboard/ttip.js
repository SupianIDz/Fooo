import { getMarker } from "../utils/xhr/markers";

export async function ttipCable(row, tube) {
    let html = '';

    html += '<div class="w-[400px] border rounded flex flex-col p-2">';
    html += `    <span class="text-center font-bold text-xl">${row.name}</span>`;
    html += `    <span class="text-center">${row.description}</span>`;

    html += '<div class="border rounded mt-3 p-2">';
    html += `    <table>`;
    html += `        <tr>`;
    html += `            <td class="font-bold">WARNA</td>`;
    html += `            <td>:</td>`;
    html += `            <td class="font-bold uppercase" style="color: ${row.color};">${row.color}</td>`;
    html += `        </tr>`;
    html += `        <tr>`;
    html += `            <td class="font-bold">PARENT</td>`;
    html += `            <td>:</td>`;
    html += `            <td class="font-bold" style="color: ${tube.color};">${tube.name}</td>`;
    html += `        </tr>`;
    html += `    </table>`;
    html += '</div>';

    let lastline = row.lines[row.lines.length - 1];
    if (lastline.children.length > 0) {
        let marker = await getMarker(lastline.attached_on);

        html += '<div class="border rounded mt-3 p-2">';
        html += `    <table>`;
        html += `        <tr>`;
        html += `            <td class="font-bold">TERPASANG PADA</td>`;
        html += `            <td>:</td>`;
        html += `            <td class="font-bold">${marker.name}</td>`;
        html += `        </tr>`;
        html += `        <tr>`;
        html += `            <td class="font-bold">JUMLAH CABANG</td>`;
        html += `            <td>:</td>`;
        html += `            <td><span class="font-bold">${lastline.children.length} </span><small>kabel</small></td>`;
        html += `        </tr>`;
        html += `        <tr>`;
        html += `            <td class="font-bold">DI ALAMAT</td>`;
        html += `            <td>:</td>`;
        html += `            <td class="font-bold">${marker.address}</td>`;
        html += `        </tr>`;
        html += `    </table>`;
        html += '</div>';
    }

    html += '</div>';

    return html;
}

export async function ttipCableODC(row, cable, tube) {
    let html = '';

    html += '<div class="w-[400px] border rounded flex flex-col p-2">';
    html += `    <span class="text-center font-bold text-xl">${row.name}</span>`;
    html += `    <span class="text-center">${row.description ?? '-'}</span>`;

    html += '<div class="border rounded mt-3 p-2">';
    html += `    <table>`;
    html += `        <tr>`;
    html += `            <td class="font-bold">WARNA</td>`;
    html += `            <td>:</td>`;
    html += `            <td class="font-bold uppercase" style="color: ${row.color};">${row.color}</td>`;
    html += `        </tr>`;
    html += `        <tr>`;
    html += `            <td class="font-bold">PARENT</td>`;
    html += `            <td>:</td>`;
    html += `            <td class="font-bold" style="color: ${tube.color};">${tube.name}</td>`;
    html += `        </tr>`;
    html += `    </table>`;
    html += '</div>';

    let lastlineCable = cable.lines[cable.lines.length - 1];
    let markerCable = await getMarker(lastlineCable.attached_on);

    html += '<div class="border rounded mt-3 p-2">';
    html += `    <table>`;
    html += `        <tr>`;
    html += `            <td class="font-bold">TERPASANG PADA</td>`;
    html += `            <td>:</td>`;
    html += `            <td class="font-bold">${markerCable.name}</td>`;
    html += `        </tr>`;
    html += `        <tr>`;
    html += `            <td class="font-bold">DI PORT</td>`;
    html += `            <td>:</td>`;
    html += `            <td class="font-bold">${row.port_name}</td>`;
    html += `        </tr>`;
    html += `    </table>`;
    html += '</div>';

    let lastline = row.lines_detail[row.lines_detail.length - 1];
    if (lastline.children.length > 0) {
        let marker = await getMarker(lastline.attached_on);

        html += '<div class="border rounded mt-3 p-2">';
        html += `    <table>`;
        html += `        <tr>`;
        html += `            <td class="font-bold">TERPASANG PADA</td>`;
        html += `            <td>:</td>`;
        html += `            <td class="font-bold">${marker.name}</td>`;
        html += `        </tr>`;
        html += `        <tr>`;
        html += `            <td class="font-bold">JUMLAH CABANG</td>`;
        html += `            <td>:</td>`;
        html += `            <td><span class="font-bold">${lastline.children.length} </span><small>kabel</small></td>`;
        html += `        </tr>`;
        html += `        <tr>`;
        html += `            <td class="font-bold">DI ALAMAT</td>`;
        html += `            <td>:</td>`;
        html += `            <td class="font-bold">${marker.address}</td>`;
        html += `        </tr>`;
        html += `    </table>`;
        html += '</div>';
    }

    html += '</div>';

    return html;
}

export async function ttipCableJC(row, cable, tube) {
    let html = '';

    html += '<div class="w-[400px] border rounded flex flex-col p-2">';
    html += `    <span class="text-center font-bold text-xl">${row.name}</span>`;
    html += `    <span class="text-center">${row.description ?? '-'}</span>`;

    html += '<div class="border rounded mt-3 p-2">';
    html += `    <table>`;
    html += `        <tr>`;
    html += `            <td class="font-bold">WARNA</td>`;
    html += `            <td>:</td>`;
    html += `            <td class="font-bold uppercase" style="color: ${row.color};">${row.color}</td>`;
    html += `        </tr>`;
    html += `        <tr>`;
    html += `            <td class="font-bold">PARENT</td>`;
    html += `            <td>:</td>`;
    html += `            <td class="font-bold" style="color: ${cable.color};">${cable.name}</td>`;
    html += `        </tr>`;
    html += `    </table>`;
    html += '</div>';

    let lastlineCable = cable.lines_detail[cable.lines_detail.length - 1];
    let markerCable = await getMarker(lastlineCable.attached_on);

    html += '<div class="border rounded mt-3 p-2">';
    html += `    <table>`;
    html += `        <tr>`;
    html += `            <td class="font-bold">TERPASANG PADA</td>`;
    html += `            <td>:</td>`;
    html += `            <td class="font-bold">${markerCable.name}</td>`;
    html += `        </tr>`;
    html += `        <tr>`;
    html += `            <td class="font-bold">DI PORT</td>`;
    html += `            <td>:</td>`;
    html += `            <td class="font-bold">${row.port_name}</td>`;
    html += `        </tr>`;
    html += `    </table>`;
    html += '</div>';

    let lastline = row.lines_detail[row.lines_detail.length - 1];
    if (lastline && lastline.children && lastline.children.length > 0) {
        let marker = await getMarker(lastline.attached_on);

        html += '<div class="border rounded mt-3 p-2">';
        html += `    <table>`;
        html += `        <tr>`;
        html += `            <td class="font-bold">TERPASANG PADA</td>`;
        html += `            <td>:</td>`;
        html += `            <td class="font-bold">${marker.name}</td>`;
        html += `        </tr>`;
        html += `        <tr>`;
        html += `            <td class="font-bold">JUMLAH CABANG</td>`;
        html += `            <td>:</td>`;
        html += `            <td><span class="font-bold">${lastline.children.length} </span><small>kabel</small></td>`;
        html += `        </tr>`;
        html += `        <tr>`;
        html += `            <td class="font-bold">DI ALAMAT</td>`;
        html += `            <td>:</td>`;
        html += `            <td class="font-bold">${marker.address}</td>`;
        html += `        </tr>`;
        html += `    </table>`;
        html += '</div>';
    }

    html += '</div>';

    return html;
}

export async function ttipTube(row) {
    let html = '';

    console.log(row);
    html += '<div class="w-[400px] border rounded flex flex-col p-2 break-words">';
    html += `    <span class="text-center font-bold text-xl">${row.name}</span>`;
    html += `    <p class="text-center break-all">${row.description ?? '-'}</p>`;

    html += '<div class="border rounded mt-3 p-2">';
    html += `    <table>`;
    html += `        <tr>`;
    html += `            <td class="font-bold">WARNA</td>`;
    html += `            <td>:</td>`;
    html += `            <td class="font-bold uppercase" style="color: ${row.color};">${row.color}</td>`;
    html += `        </tr>`;
    html += `    </table>`;
    html += '</div>';

    html += '<div class="border rounded mt-3 p-2">';
    html += `    <table>`;
    html += `        <tr>`;
    html += `            <td class="font-bold">JUMLAH CORE</td>`;
    html += `            <td>:</td>`;
    html += `            <td><span class="font-bold">${row.cables.length} </span><small>core</small></td>`;
    html += `        </tr>`;
    html += `    </table>`;
    html += '</div>';

    html += '</div>';
    return html;
}
