<script setup>
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineOptions({ layout: AppLayout });

const props = defineProps({
  anime: {
    type: Object,
    required: true,
  },
});

const getTitle = (anime) => anime.title.english || anime.title.romaji || anime.title.native;

const scoreColor = (score) => {
  if (!score) return 'secondary';
  if (score >= 75) return 'success';
  if (score >= 50) return 'warning';
  return 'error';
};

const studioName = computed(() => props.anime.studios?.nodes?.[0]?.name ?? '-');

const mainCharacters = computed(() =>
  (props.anime.characters?.edges || []).filter((e) => e.role === 'MAIN'),
);

const supportingCharacters = computed(() =>
  (props.anime.characters?.edges || []).filter((e) => e.role !== 'MAIN'),
);

const goBack = () => router.get(route('dashboard'));
</script>

<template>
  <div>
    <VBtn
      variant="text"
      prepend-icon="mdi-arrow-left"
      class="mb-4"
      @click="goBack"
    >
      Kembali
    </VBtn>

    <VCard rounded="lg" class="overflow-hidden mb-6">
      <VImg
        v-if="anime.bannerImage"
        :src="anime.bannerImage"
        height="220"
        cover
        class="anime-banner"
      />

      <VCardText class="position-relative">
        <VRow>
          <VCol cols="12" sm="4" md="3" class="cover-col">
            <VImg
              :src="anime.coverImage.extraLarge || anime.coverImage.large"
              rounded="lg"
              class="cover-img elevation-4"
              cover
              width="200"
              height="280"
            />
          </VCol>

          <VCol cols="12" sm="8" md="9">
            <h3 class="text-h4 font-weight-bold mb-1">
              {{ getTitle(anime) }}
            </h3>
            <p v-if="anime.title.native" class="text-body-2 text-medium-emphasis mb-3">
              {{ anime.title.native }}
            </p>

            <div class="d-flex flex-wrap gap-2 mb-4">
              <VChip
                v-if="anime.averageScore"
                :color="scoreColor(anime.averageScore)"
                variant="elevated"
                size="small"
              >
                <VIcon icon="mdi-star" size="14" start />
                {{ anime.averageScore }}%
              </VChip>
              <VChip size="small" variant="tonal" color="primary">
                <VIcon icon="mdi-play-circle-outline" size="14" start />
                {{ anime.episodes ? anime.episodes + ' Episode' : anime.format }}
              </VChip>
              <VChip size="small" variant="tonal">
                <VIcon icon="mdi-clock-outline" size="14" start />
                {{ anime.duration ? anime.duration + ' min' : '-' }}
              </VChip>
              <VChip size="small" variant="tonal">
                <VIcon icon="mdi-calendar" size="14" start />
                {{ anime.season ? anime.season + ' ' + anime.seasonYear : (anime.seasonYear || '-') }}
              </VChip>
              <VChip size="small" variant="tonal" :color="anime.status === 'RELEASING' ? 'success' : undefined">
                {{ anime.status }}
              </VChip>
            </div>

            <div class="d-flex flex-wrap gap-1 mb-4">
              <VChip
                v-for="genre in anime.genres"
                :key="genre"
                size="small"
                variant="outlined"
                color="primary"
              >
                {{ genre }}
              </VChip>
            </div>

            <p class="text-body-2">
              <VIcon icon="mdi-domain" size="16" class="me-1" />
              <strong>Studio:</strong> {{ studioName }}
            </p>
          </VCol>
        </VRow>
      </VCardText>
    </VCard>

    <VCard rounded="lg" class="mb-6">
      <VCardItem>
        <VCardTitle class="d-flex align-center">
          <VIcon icon="mdi-text-box-outline" class="me-2" />
          Deskripsi
        </VCardTitle>
      </VCardItem>
      <VCardText>
        <p class="text-body-1 description-text">
          {{ anime.description || 'Deskripsi tidak tersedia.' }}
        </p>
      </VCardText>
    </VCard>

    <VCard rounded="lg" v-if="mainCharacters.length || supportingCharacters.length">
      <VCardItem>
        <VCardTitle class="d-flex align-center">
          <VIcon icon="mdi-account-group-outline" class="me-2" />
          Karakter
        </VCardTitle>
      </VCardItem>
      <VCardText>
        <div v-if="mainCharacters.length" class="mb-6">
          <h6 class="text-subtitle-1 font-weight-bold mb-3">Karakter Utama</h6>
          <VRow>
            <VCol
              v-for="edge in mainCharacters"
              :key="edge.node.id"
              cols="6"
              sm="4"
              md="3"
              lg="2"
            >
              <div class="character-card text-center">
                <VAvatar size="88" rounded="lg" class="elevation-2 mb-2">
                  <VImg :src="edge.node.image.large || edge.node.image.medium" cover />
                </VAvatar>
                <p class="text-body-2 font-weight-medium character-name mb-0">
                  {{ edge.node.name.full }}
                </p>
                <VChip size="x-small" color="primary" variant="tonal" class="mt-1">
                  Main
                </VChip>
                <p v-if="edge.voiceActors?.[0]" class="text-caption text-medium-emphasis mt-1 mb-0">
                  <VIcon icon="mdi-microphone-outline" size="12" />
                  {{ edge.voiceActors[0].name.full }}
                </p>
              </div>
            </VCol>
          </VRow>
        </div>

        <div v-if="supportingCharacters.length">
          <h6 class="text-subtitle-1 font-weight-bold mb-3">Karakter Pendukung</h6>
          <VRow>
            <VCol
              v-for="edge in supportingCharacters"
              :key="edge.node.id"
              cols="6"
              sm="4"
              md="3"
              lg="2"
            >
              <div class="character-card text-center">
                <VAvatar size="72" rounded="lg" class="elevation-1 mb-2">
                  <VImg :src="edge.node.image.large || edge.node.image.medium" cover />
                </VAvatar>
                <p class="text-body-2 character-name mb-0">
                  {{ edge.node.name.full }}
                </p>
                <p v-if="edge.voiceActors?.[0]" class="text-caption text-medium-emphasis mt-1 mb-0">
                  <VIcon icon="mdi-microphone-outline" size="12" />
                  {{ edge.voiceActors[0].name.full }}
                </p>
              </div>
            </VCol>
          </VRow>
        </div>
      </VCardText>
    </VCard>
  </div>
</template>

<style scoped>
.cover-col {
  display: flex;
  justify-content: center;
  margin-top: -64px;
}

.cover-img {
  border: 4px solid rgb(var(--v-theme-surface));
}

.description-text {
  white-space: pre-line;
  line-height: 1.7;
}

.character-name {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

@media (min-width: 600px) {
  .cover-col {
    justify-content: flex-start;
  }
}
</style>