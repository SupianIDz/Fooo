export function markerToolTip(row) {
    let html = '';

    html += '<div class="w-[300px] border rounded flex flex-col p-2">';
    html += `    <span class="text-center font-bold text-xl">${row.name}</span>`;
    html += `    <span class="text-center">${row.address ?? '-'}</span>`;
    html += '</div>';

    return html;
}
