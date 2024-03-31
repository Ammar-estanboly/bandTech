<?php


namespace App\Traits\General;

use Illuminate\Support\Facades\Storage;
use \Illuminate\Http\UploadedFile;

trait FileManagerTrait
{
    /**
     * Uploads a file to the specified storage location and returns the path.
     *
     * @param \Illuminate\Http\UploadedFile $file The file to upload
     * @param string $folders The subfolder(s) within "public" to store the file (separated by '/')
     * @return string The full path to the uploaded file (including "/storage/")
     */
    public function uploadFile(UploadedFile $file, string $folders): string
    {
        return '/storage/' . $file->storeAs($folders, $this->createName($file), 'public');
    }

    /**
     * Generates a unique filename based on the current timestamp and original filename.
     *
     * @param \Illuminate\Http\UploadedFile $file The file for which to generate a filename
     * @return string The generated filename
     */
    public function createName(UploadedFile $file): string
    {
        return time() . '_' . $file->getClientOriginalName();
    }

    /**
     * Deletes the old file from the specified path and uploads a new file.
     *
     * @param string $path The path to the old file (including "/storage/")
     * @param \Illuminate\Http\UploadedFile $file The new file to upload
     * @param string $folders The subfolder(s) within "public" to store the new file (separated by '/')
     * @return string The full path to the uploaded file (including "/storage/")
     */
    public function fileManage(string $path, UploadedFile $file, string $folders): string
    {
        $this->deleteFile($this->getrealpath($path));
        return $this->uploadFile($file, $folders);
    }

    /**
     * Gets the real path of the file after applying the `asset` function.
     *
     * @param string $path The path to the file (including "/storage/")
     * @return string The real path of the file (relative to the public directory)
     */
    public function getrealpath(string $path): string
    {
        return 'public/' . substr($path, strpos($path, 'storage/') + 7);
    }

    /**
     * Deletes the file at the specified path if it exists.
     *
     * @param string $path The path to the file (including "/storage/")
     * @return bool True if the file was deleted successfully, false otherwise
     */
    public function deleteFile(string $path): bool
    {
        $path = $this->getrealpath($path);
        if (Storage::exists($path)) {
            Storage::delete($path);
            return true;
        }

        return false;
    }
}
