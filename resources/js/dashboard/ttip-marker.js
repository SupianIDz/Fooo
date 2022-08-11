export function ttipMarker(row) {

    let html = '';

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

    return html;
}
