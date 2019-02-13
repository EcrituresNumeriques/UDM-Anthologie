export default function (text) {
  if (!text) return ''

  return text.toString()
    .toLowerCase()
    .replace('/(é|è|ê)/g', 'e')
    .replace('/à/g', 'a')
    .replace(/\s+/g, '-')         // Replace spaces with -
    .replace(/[^\w-]+/g, '')      // Remove all non-word chars
    .replace(/--+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')           // Trim - from start of text
    .replace(/-+$/, '')           // Trim - from end of text
}
