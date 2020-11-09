<div id="right-sidebar" class="settings-panel">
    <i class="settings-close ti-close"></i>
    <div class="tab-content" id="setting-content">
        <div class="tab-pane fade show active scroll-wrapper" id="selection-section" role="tabpanel"
             aria-labelledby="selection-section">
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Selections</h4>
            <div class="p-3">


                <form name="selectionsForm" id="selectionsForm">
                        <livewire:user-selections />
                    <div class="row">
                        <div class="form-group">
                            <label for="selectSchool">Select School</label>
                            <select class="form-control" id="selectSchool">
                                <option>Wait for it...</option>
                            </select>
                        </div>
                    </div>
                </form>





            </div>
        </div>
    </div>
</div>
