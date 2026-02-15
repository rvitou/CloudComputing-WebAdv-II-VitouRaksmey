    @extends('layouts.public')

    @section('title', $country->name . ' Currencies' ?? 'Currency Details') {{-- Dynamic title based on country name --}}

    @section('content')
        <section class="currency-detail-wrapper">
            {{-- TOP SECTION: Description on left, Main Image on right --}}
            <div class="currency-detail-header">
                <div class="currency-detail-content">
                    <h1 id="country-currency-title">{{ $country->name ?? 'Loading Country...' }} Currencies</h1>
                    <p id="country-currency-description">{{ $country->description ?? 'Loading description...' }}</p>
                </div>
                <div class="currency-detail-image">
                    <img id="country-currency-main-image" src="{{ asset($country->main_currency_image_path ?? 'https://via.placeholder.com/400x250/E0E0E0/888888?text=Select+Country') }}" alt="Currency of Selected Country">
                </div>
            </div>

            {{-- BOTTOM SECTION: Search Bar and Currency Notes Grid --}}
            <div class="currency-notes-section">
                <div class="currency-controls">
                    <input type="text" id="currency-search-input" placeholder="Search currency notes by denomination, year, or info...">
                    {{-- Add a sort dropdown here later if needed --}}
                </div>

                <div id="currency-notes-grid" class="currency-grid">
                    {{-- Individual currency notes will be dynamically inserted here by JavaScript --}}
                    <p id="no-notes-message" style="display: none;">No currency notes found for this country matching your search.</p>
                </div>
            </div>
        </section>

        {{-- MODAL STRUCTURE FOR ENLARGED IMAGE (simple click on image) --}}
        <div id="imageModal" class="modal-overlay">
            <div class="modal-content">
                <button class="modal-close-btn">&times;</button>
                <img id="enlargedImage" class="modal-image" src="" alt="Enlarged Currency Note">
                <button id="downloadImageBtn" class="modal-download-btn">Download Image</button>
            </div>
        </div>

        {{-- MODAL STRUCTURE FOR INDIVIDUAL NOTE DETAILS (click on Detail button) --}}
        <div id="noteDetailModal" class="modal-overlay">
            <div class="modal-content note-detail-modal-content">
                <button class="modal-close-btn">&times;</button>
                <h2 id="noteDetailTitle"></h2>
                <div class="note-detail-images">
                    <img id="noteDetailFrontImg" src="" alt="Note Front">
                    <img id="noteDetailBackImg" src="" alt="Note Back">
                </div>
                <div class="note-detail-info">
                    <p><strong>Denomination:</strong> <span id="noteDetailDenomination"></span></p>
                    <p><strong>Year:</strong> <span id="noteDetailYear"></span></p>
                    <p id="noteDetailVersionContainer" style="display: none;"><strong>Version:</strong> <span id="noteDetailVersion"></span></p>
                    <p><strong>Material:</strong> <span id="noteDetailMaterial"></span></p>
                    <p id="noteDetailSeriesContainer" style="display: none;"><strong>Series:</strong> <span id="noteDetailSeries"></span></p>
                    <p><strong>Status:</strong> <span id="noteDetailStatus"></span></p>
                    <p><strong>Issued:</strong> <span id="noteDetailStartDate"></span></p>
                    <p id="noteDetailEndDateContainer" style="display: none;"><strong>Stopped:</strong> <span id="noteDetailEndDate"></span></p>
                    <p id="noteDetailAdditionalInfoContainer" style="display: none;"><strong>Additional Info:</strong> <span id="noteDetailAdditionalInfo"></span></p>
                </div>
                <button id="noteDetailDownloadBtn" class="modal-download-btn">Download Note Images</button>
            </div>
        </div>

    @endsection

    @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Get the currency notes/coins data passed from the Laravel controller
            // This will be a collection of Currency models for the selected country
            const allNotesForCountry = @json($country->currencies);

            // --- DEBUGGING LINE ---
            console.log('Currency data received:', allNotesForCountry);
            // --- END DEBUGGING LINE ---

            const currencyNotesGrid = document.getElementById('currency-notes-grid');
            const searchInput = document.getElementById('currency-search-input');
            const noNotesMessage = document.getElementById('no-notes-message');

            let displayedNotes = []; // To hold notes currently being displayed after filtering

            // Function to render currency notes
            function renderNotes(notesToRender) {
                currencyNotesGrid.innerHTML = ''; // Clear existing notes
                displayedNotes = notesToRender; // Update displayed notes

                if (notesToRender.length === 0) {
                    noNotesMessage.style.display = 'block';
                    return;
                } else {
                    noNotesMessage.style.display = 'none';
                }

                notesToRender.forEach(note => {
                    const noteCard = document.createElement('div');
                    noteCard.classList.add('currency-card');
                    // Ensure 'id' is used for data-note-id
                    // Use asset() helper in Blade for image paths, then concatenate in JS
                    noteCard.innerHTML = `
                        <img src="{{ asset('') }}${note.front_image_path}" alt="${note.denomination} ${note.type || 'Note'} Front" class="currency-note-image" data-front="{{ asset('') }}${note.front_image_path}" data-back="{{ asset('') }}${note.back_image_path}">
                        <h4>${note.denomination} ${note.type || ''} (${note.year})</h4>
                        <p>Status: ${note.is_active ? 'Active' : 'Stopped'}</p>
                        <button class="btn btn-detail" data-note-id="${note.id}">Details</button>
                    `;
                    currencyNotesGrid.appendChild(noteCard);
                });
            }

            // Initial render of all notes
            renderNotes(allNotesForCountry);

            // Search functionality
            searchInput.addEventListener('input', (event) => {
                const searchTerm = event.target.value.toLowerCase();
                const filteredNotes = allNotesForCountry.filter(note => {
                    const denomination = String(note.denomination).toLowerCase();
                    const year = String(note.year).toLowerCase();
                    const material = (note.material || '').toLowerCase();
                    const status = (note.is_active ? 'active' : 'stopped').toLowerCase();
                    const additionalInfo = (note.description || '').toLowerCase(); // Use 'description' from model
                    const version = (note.version || '').toLowerCase();
                    const type = (note.type || '').toLowerCase();
                    const series = (note.series || '').toLowerCase();

                    return denomination.includes(searchTerm) ||
                           year.includes(searchTerm) ||
                           material.includes(searchTerm) ||
                           status.includes(searchTerm) ||
                           additionalInfo.includes(searchTerm) ||
                           version.includes(searchTerm) ||
                           type.includes(searchTerm) ||
                           series.includes(searchTerm);
                });
                renderNotes(filteredNotes);
            });

            // --- Modals Logic ---

            // Image Modal Elements
            const imageModal = document.getElementById('imageModal');
            const enlargedImage = document.getElementById('enlargedImage');
            const downloadImageBtn = document.getElementById('downloadImageBtn');
            const imageModalCloseBtn = imageModal.querySelector('.modal-close-btn');

            // Note Detail Modal Elements
            const noteDetailModal = document.getElementById('noteDetailModal');
            const noteDetailTitle = document.getElementById('noteDetailTitle');
            const noteDetailFrontImg = document.getElementById('noteDetailFrontImg');
            const noteDetailBackImg = document.getElementById('noteDetailBackImg');
            const noteDetailDenomination = document.getElementById('noteDetailDenomination');
            const noteDetailYear = document.getElementById('noteDetailYear');
            const noteDetailVersion = document.getElementById('noteDetailVersion');
            const noteDetailVersionContainer = document.getElementById('noteDetailVersionContainer');
            const noteDetailMaterial = document.getElementById('noteDetailMaterial');
            const noteDetailSeries = document.getElementById('noteDetailSeries');
            const noteDetailSeriesContainer = document.getElementById('noteDetailSeriesContainer');
            const noteDetailStatus = document.getElementById('noteDetailStatus');
            const noteDetailStartDate = document.getElementById('noteDetailStartDate');
            const noteDetailEndDate = document.getElementById('noteDetailEndDate');
            const noteDetailEndDateContainer = document.getElementById('noteDetailEndDateContainer');
            const noteDetailAdditionalInfo = document.getElementById('noteDetailAdditionalInfo');
            const noteDetailAdditionalInfoContainer = document.getElementById('noteDetailAdditionalInfoContainer');
            const noteDetailDownloadBtn = document.getElementById('noteDetailDownloadBtn');
            const noteDetailModalCloseBtn = noteDetailModal.querySelector('.modal-close-btn');

            // Close modal function
            function closeModals() {
                imageModal.style.display = 'none';
                noteDetailModal.style.display = 'none';
            }

            // Event listener for closing modals
            imageModalCloseBtn.addEventListener('click', closeModals);
            noteDetailModalCloseBtn.addEventListener('click', closeModals);
            window.addEventListener('click', (event) => {
                if (event.target === imageModal || event.target === noteDetailModal) {
                    closeModals();
                }
            });

            // Event listener for opening image modal (clicking on note image)
            currencyNotesGrid.addEventListener('click', (event) => {
                if (event.target.classList.contains('currency-note-image')) {
                    const frontImgSrc = event.target.dataset.front;
                    enlargedImage.src = frontImgSrc;
                    downloadImageBtn.href = frontImgSrc; // Set download link
                    downloadImageBtn.download = frontImgSrc.split('/').pop(); // Set download filename
                    imageModal.style.display = 'flex';
                }
            });

            // Event listener for opening note detail modal (clicking on Detail button)
            currencyNotesGrid.addEventListener('click', (event) => {
                if (event.target.classList.contains('btn-detail')) {
                    const noteId = parseInt(event.target.dataset.noteId); // CORRECTED: dataset.noteId
                    // Find the note (which is a Currency model instance) by ID
                    const note = allNotesForCountry.find(n => n.id === noteId);

                    if (note) {
                        noteDetailTitle.textContent = `${note.denomination} ${note.type || ''} (${note.year})`;
                        noteDetailFrontImg.src = `{{ asset('') }}${note.front_image_path}`;
                        noteDetailBackImg.src = `{{ asset('') }}${note.back_image_path}`;
                        noteDetailDenomination.textContent = note.denomination;
                        noteDetailYear.textContent = note.year;
                        noteDetailMaterial.textContent = note.material;
                        noteDetailStatus.textContent = note.is_active ? 'Active' : 'Stopped'; // Map boolean to string
                        noteDetailStartDate.textContent = note.issue_date; // Use issue_date

                        // Conditionally display optional fields
                        if (note.version) {
                            noteDetailVersionContainer.style.display = 'block';
                            noteDetailVersion.textContent = note.version;
                        } else {
                            noteDetailVersionContainer.style.display = 'none';
                        }

                        if (note.series) {
                            noteDetailSeriesContainer.style.display = 'block';
                            noteDetailSeries.textContent = note.series;
                        } else {
                            noteDetailSeriesContainer.style.display = 'none';
                        }

                        if (note.deactivated_end_date) { // Use deactivated_end_date
                            noteDetailEndDateContainer.style.display = 'block';
                            noteDetailEndDate.textContent = note.deactivated_end_date;
                        } else {
                            noteDetailEndDateContainer.style.display = 'none';
                        }

                        if (note.description) { // Use 'description' from model
                            noteDetailAdditionalInfoContainer.style.display = 'block';
                            noteDetailAdditionalInfo.textContent = note.description;
                        } else {
                            noteDetailAdditionalInfoContainer.style.display = 'none';
                        }

                        // Set download link for both front and back images
                        noteDetailDownloadBtn.onclick = () => {
                            // Trigger download for front image
                            const aFront = document.createElement('a');
                            aFront.href = `{{ asset('') }}${note.front_image_path}`;
                            aFront.download = note.front_image_path.split('/').pop();
                            document.body.appendChild(aFront);
                            aFront.click();
                            document.body.removeChild(aFront);

                            // Trigger download for back image
                            const aBack = document.createElement('a');
                            aBack.href = `{{ asset('') }}${note.back_image_path}`;
                            aBack.download = note.back_image_path.split('/').pop();
                            document.body.appendChild(aBack);
                            aBack.click();
                            document.body.removeChild(aBack);

                            // Log the download action
                            logDownload(note.id); // Pass the currency (note) ID
                        };

                        noteDetailModal.style.display = 'flex';
                    }
                }
            });

            // Function to log download action
            async function logDownload(currencyId) {
                try {
                    const response = await fetch('{{ route('log.download') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ currency_id: currencyId })
                    });

                    const data = await response.json();
                    if (data.success) {
                        console.log('Download logged successfully:', data.message);
                    } else {
                        console.warn('Failed to log download:', data.message);
                    }
                } catch (error) {
                    console.error('Error logging download:', error);
                }
            }
        });
    </script>
    @endsection
    